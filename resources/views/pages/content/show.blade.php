@extends('layouts.landing')

@section('hero')
    <!-- Page-title -->
    <div class="page-title page-about-us">
        <div class="rellax" data-rellax-speed="5">
            <img src="{{ asset('assets/images/page-title/about-us.jpg') }}" alt="">
        </div>
        <div class="content-wrap">
            <div class="tf-container w-1290">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="content">
                            <p class="sub-title">
                                Nurturing the Earth, Feeding the World
                            </p>
                            <h1 class="title">
                                {{ $page->name }}
                            </h1>
                            <div class="icon-img">
                                <img src="{{ asset('assets/images/item/line-throw-title.png') }}" alt="">
                            </div>
                            <div class="breadcrumb">
                                <a href="{{ url('/') }}">Home</a>
                                <div class="icon">
                                    <i class="icon-arrow-right1"></i>
                                </div>
                                <a href="#">{{ $page->name }} </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="img-item item-2">
            <img src="{{ asset('assets/images/item/grass.png') }}" alt="">
        </div>
    </div><!-- /.Page-title -->
@endsection

@section('content')
    <section class="page-content-section">
        <div class="tf-container w-1290">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="page-content-wrapper">
                        {!! $page->content !!}
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

<style>
    .page-content-section {
        padding: 80px 0;
        background-color: #f8f9fa;
    }

    .page-content-wrapper {
        /* background: #ffffff; */
        padding: 50px;
        border-radius: 10px;
        /* box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08); */
    }

    /* Typography Styles */
    .page-content-wrapper h1,
    .page-content-wrapper h2,
    .page-content-wrapper h3,
    .page-content-wrapper h4,
    .page-content-wrapper h5,
    .page-content-wrapper h6 {
        margin-top: 30px;
        margin-bottom: 20px;
        color: #2c3e50;
        font-weight: 600;
        line-height: 1.4;
    }

    .page-content-wrapper h1 {
        font-size: 2.5rem;
    }

    .page-content-wrapper h2 {
        font-size: 2rem;
    }

    .page-content-wrapper h3 {
        font-size: 1.75rem;
    }

    .page-content-wrapper h4 {
        font-size: 1.5rem;
    }

    .page-content-wrapper h5 {
        font-size: 1.25rem;
    }

    .page-content-wrapper h6 {
        font-size: 1.1rem;
    }

    .page-content-wrapper p {
        margin-bottom: 20px;
        line-height: 1.8;
        color: #555;
        font-size: 16px;
    }

    /* List Styles */
    .page-content-wrapper ul,
    .page-content-wrapper ol {
        margin: 20px 0;
        padding-left: 30px;
    }

    .page-content-wrapper ul li,
    .page-content-wrapper ol li {
        margin-bottom: 10px;
        line-height: 1.8;
        color: #555;
    }

    .page-content-wrapper ul {
        list-style-type: disc;
    }

    /* Images */
    .page-content-wrapper img {
        max-width: 100%;
        height: auto;
        border-radius: 8px;
        margin: 30px 0;
        box-shadow: 0 3px 15px rgba(0, 0, 0, 0.1);
    }

    /* Blockquote */
    .page-content-wrapper blockquote {
        border-left: 4px solid #4CAF50;
        padding: 20px 30px;
        margin: 30px 0;
        background: #f8f9fa;
        font-style: italic;
        color: #555;
        border-radius: 0 8px 8px 0;
    }

    /* Links */
    .page-content-wrapper a {
        color: #4CAF50;
        text-decoration: none;
        transition: color 0.3s ease;
    }

    .page-content-wrapper a:hover {
        color: #45a049;
        text-decoration: underline;
    }

    /* Tables */
    .page-content-wrapper table {
        width: 100%;
        margin: 30px 0;
        border-collapse: collapse;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
    }

    .page-content-wrapper table th,
    .page-content-wrapper table td {
        padding: 15px;
        text-align: left;
        border: 1px solid #ddd;
    }

    .page-content-wrapper table th {
        background-color: #4CAF50;
        color: white;
        font-weight: 600;
    }

    .page-content-wrapper table tr:nth-child(even) {
        background-color: #f8f9fa;
    }

    /* Code Blocks */
    .page-content-wrapper pre {
        background: #2c3e50;
        color: #ecf0f1;
        padding: 20px;
        border-radius: 8px;
        overflow-x: auto;
        margin: 30px 0;
    }

    .page-content-wrapper code {
        background: #f4f4f4;
        padding: 3px 8px;
        border-radius: 4px;
        font-family: 'Courier New', monospace;
        color: #e74c3c;
    }

    /* Responsive */
    @media (max-width: 991px) {
        .page-content-section {
            padding: 60px 0;
        }

        .page-content-wrapper {
            padding: 40px 30px;
        }

        .page-content-wrapper h1 {
            font-size: 2rem;
        }

        .page-content-wrapper h2 {
            font-size: 1.75rem;
        }

        .page-content-wrapper h3 {
            font-size: 1.5rem;
        }
    }

    @media (max-width: 767px) {
        .page-content-section {
            padding: 40px 0;
        }

        .page-content-wrapper {
            padding: 30px 20px;
        }

        .page-content-wrapper h1 {
            font-size: 1.75rem;
        }

        .page-content-wrapper h2 {
            font-size: 1.5rem;
        }

        .page-content-wrapper h3 {
            font-size: 1.25rem;
        }
    }

    .page-content-wrapper p:first-of-type {
        font-size: 18px;
        color: #333;
        font-weight: 500;
    }

    .page-content-wrapper hr {
        margin: 40px 0;
        border: none;
        border-top: 2px solid #e0e0e0;
    }
</style>
