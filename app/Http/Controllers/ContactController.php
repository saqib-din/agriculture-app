<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use App\Models\ContactMessage;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use App\Models\Variable;

class ContactController extends Controller
{
    // Contact form view
    public function show()
    {
        $variables = Variable::all();
        return view('pages.contacts.contact-us', compact('variables'));
    }

    // Admin contact list
    public function index()
    {
        $contacts = ContactMessage::latest()->get();
        return view('pages.admin-side.contacts.index', compact('contacts'));
    }

    public function store(Request $request)
    {
        // Validation
        $validated = $request->validate([
            'name'    => ['required', 'string', 'max:255'],
            'subject' => ['required', 'string', 'max:255'],
            'email'   => ['required', 'email', 'max:255'],
            'phone'   => ['required', 'string', 'max:50'],
            'message' => ['required', 'string', 'max:2000'],
            'terms'   => ['accepted'],
            'recaptcha_token' => ['required']  // v3 ke liye
        ], [
            'recaptcha_token.required' => 'reCAPTCHA verification failed.'
        ]);

        // Google reCAPTCHA v3 verification
        $response = Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify', [
            'secret' => config('services.recaptcha.secret_key'),
            'response' => $request->input('recaptcha_token'),
            'remoteip' => $request->ip()
        ]);

        if ($response->failed()) {
            return back()
                ->with('error', 'Unable to verify reCAPTCHA. Please try again.')
                ->withInput();
        }

        $recaptchaData = $response->json();

        // Check if verification successful
        if (!$recaptchaData['success']) {
            Log::warning('reCAPTCHA verification failed', [
                'error_codes' => $recaptchaData['error-codes'] ?? [],
                'ip' => $request->ip()
            ]);

            return back()
                ->with('error', 'reCAPTCHA verification failed. Please try again.')
                ->withInput();
        }

        // Score check (v3 feature)
        $score = $recaptchaData['score'] ?? 0;
        $threshold = config('services.recaptcha.threshold', 0.5);

        if ($score < $threshold) {
            Log::warning('Low reCAPTCHA score detected', [
                'score' => $score,
                'ip' => $request->ip(),
                'email' => $validated['email']
            ]);

            return back()
                ->with('error', 'Suspicious activity detected. Please try again.')
                ->withInput();
        }

        // Log successful submission
        Log::info('Contact form submitted', [
            'recaptcha_score' => $score,
            'email' => $validated['email'],
            'name' => $validated['name']
        ]);

        // Save to database
        $contact = ContactMessage::create([
            'name' => $validated['name'],
            'subject' => $validated['subject'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'message' => $validated['message'],
            'terms_accepted_time' => now(),
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
        ]);

        // Send acknowledgment email
        if ($validated['email']) {
            try {
                Mail::raw(
                    "Hello {$validated['name']},\n\nThank you for contacting us. We have received your message and will get back to you soon.\n\nBest regards,\n" . config('app.name'),
                    function ($message) use ($validated) {
                        $message->to($validated['email'])
                            ->subject('Contact Form Received - ' . config('app.name'));
                    }
                );
            } catch (\Exception $e) {
                Log::error('Mail Error (Store): ' . $e->getMessage(), [
                    'contact_id' => $contact->id,
                    'email' => $validated['email']
                ]);
            }
        }

        return back()->with('success', 'Thank you! Your message has been sent successfully.');
    }

    public function reply(Request $request, $id)
    {
        $contact = ContactMessage::findOrFail($id);

        // Check if already replied
        if ($contact->is_replied) {
            return back()->with('error', 'You have already replied to this contact!');
        }

        $request->validate([
            'reply_message' => ['required', 'string', 'max:5000'],
        ]);

        if (!$contact->email) {
            return back()->with('error', 'No email found for this contact!');
        }

        try {
            // Send reply email
            Mail::raw($request->reply_message, function ($message) use ($contact) {
                $message->to($contact->email)
                    ->subject('Reply from ' . config('app.name'));
            });

            // Update database
            $contact->update([
                'reply_message' => $request->reply_message,
                'is_replied' => true,
                'replied_at' => now(),
            ]);

            Log::info('Reply sent successfully', [
                'contact_id' => $contact->id,
                'email' => $contact->email
            ]);

            return back()->with('success', 'Reply sent successfully!');
        } catch (\Exception $e) {
            Log::error('Mail Error (Reply): ' . $e->getMessage(), [
                'contact_id' => $contact->id,
                'email' => $contact->email
            ]);

            return back()->with('error', 'Error sending email: ' . $e->getMessage());
        }
    }

    // AJAX: Show contact details
    public function showMessage($id)
    {
        $contact = ContactMessage::findOrFail($id);
        return response()->json($contact);
    }

    // Delete contact
    public function destroy($id)
    {
        $contact = ContactMessage::findOrFail($id);
        $contact->delete();

        Log::info('Contact deleted', [
            'contact_id' => $id,
            'name' => $contact->name
        ]);

        return back()->with('success', 'Contact deleted successfully!');
    }
}
