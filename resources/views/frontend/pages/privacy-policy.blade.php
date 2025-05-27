@extends('frontend.layout.master')

@section('content')

    {{-- Optional Image Section --}}
    @if (!empty($privacy->image))
        <div class="page-banner">
            <img src="{{ asset($privacy->image) }}" alt="{{ $privacy->title }}" class="img-fluid w-100" style="max-height: 400px; object-fit: cover;">
        </div>
    @endif
    <div class="privacy-policy-container py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10 col-xl-8">
                    <article class="privacy-policy-content">
                        {!! $privacy->content !!}
                    </article>
                </div>
            </div>
        </div>
    </div>

    <style>
        /* Base styling for the privacy policy content */
        .privacy-policy-content {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.8;
            color: #333;
        }

        .privacy-policy-content h1,
        .privacy-policy-content h2,
        .privacy-policy-content h3,
        .privacy-policy-content h4 {
            margin-top: 2rem;
            margin-bottom: 1rem;
            color: #222;
            font-weight: 600;
        }

        .privacy-policy-content h1 {
            font-size: 2rem;
            border-bottom: 1px solid #eee;
            padding-bottom: 0.5rem;
        }

        .privacy-policy-content h2 {
            font-size: 1.75rem;
        }

        .privacy-policy-content h3 {
            font-size: 1.5rem;
        }

        .privacy-policy-content p {
            margin-bottom: 1.5rem;
            font-size: 1.1rem;
        }

        .privacy-policy-content ul,
        .privacy-policy-content ol {
            margin-bottom: 1.5rem;
            padding-left: 2rem;
        }

        .privacy-policy-content li {
            margin-bottom: 0.5rem;
        }

        .privacy-policy-content a {
            color: #0066cc;
            text-decoration: underline;
        }

        .privacy-policy-content a:hover {
            color: #004499;
        }

        .privacy-policy-content strong {
            font-weight: 600;
        }

        .privacy-policy-content em {
            font-style: italic;
        }

        .privacy-policy-content blockquote {
            border-left: 4px solid #ddd;
            padding: 1rem 1.5rem;
            margin: 1.5rem 0;
            background-color: #f9f9f9;
            color: #555;
        }

        .privacy-policy-content table {
            width: 100%;
            border-collapse: collapse;
            margin: 1.5rem 0;
        }

        .privacy-policy-content table th,
        .privacy-policy-content table td {
            padding: 0.75rem;
            border: 1px solid #ddd;
        }

        .privacy-policy-content table th {
            background-color: #f5f5f5;
            font-weight: 600;
        }
    </style>
@endsection
