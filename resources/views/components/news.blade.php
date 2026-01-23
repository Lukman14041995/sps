<section id="news" class="news-section">

    <!-- HEADER -->
    <div class="news-header">
        <h2>Latest <span>News</span></h2>
        <p>
            Updates and highlights from SPS Corporate and our business units.
        </p>
        <div class="news-divider"></div>
    </div>

    <!-- NEWS GRID -->
    <div class="news-grid">

        @forelse ($latestNews as $index => $news)
            <article class="news-card {{ $index >= 2 ? 'hide-mobile' : '' }}">

                <!-- IMAGE -->
                <div class="news-image">
                    <img src="{{ $news->thumbnail_image ? Storage::disk('s3')->url($news->thumbnail_image) : asset('img/news/default.jpg') }}"
                        alt="{{ $news->title }}">
                </div>

                <!-- CONTENT -->
                <div class="news-content">

                    <span class="news-date">
                        {{ optional($news->published_at)->format('d M Y') ?? $news->created_at->format('d M Y') }}
                    </span>

                    <h3 class="news-title">
                        {{ $news->title }}
                    </h3>

                    <p class="news-excerpt">
                        {{ $news->excerpt ?? Str::limit(strip_tags($news->content), 120) }}
                    </p>

                    <a href="{{ route('frontend.news.show', $news->slug) }}" class="news-link">
                        Read More →
                    </a>

                </div>
            </article>
        @empty
            <p class="news-empty">No news available.</p>
        @endforelse

    </div>

    <!-- CTA -->
    <div class="news-cta">
        <a href="{{ route('frontend.news.index') }}" class="news-cta-btn">
            View All News
        </a>
    </div>

    <!-- STYLE -->
    <style>
        /* ===============================
           SECTION
        =============================== */
        .news-section {
            padding: 5rem 0;
            background: linear-gradient(to bottom, #f8fafc, #ffffff);
        }

        /* ===============================
           HEADER
        =============================== */
        .news-header {
            text-align: center;
            max-width: 720px;
            margin: 0 auto 3.5rem;
            padding: 0 1rem;
        }

        .news-header h2 {
            font-size: clamp(1.9rem, 4vw, 2.5rem);
            font-weight: 700;
            color: #0f172a;
        }

        .news-header h2 span {
            color: #062557;
        }

        .news-header p {
            margin-top: .75rem;
            color: #64748b;
            font-size: 1rem;
            line-height: 1.6;
        }

        .news-divider {
            width: 90px;
            height: 4px;
            margin: 1.5rem auto 0;
            border-radius: 999px;
            background: linear-gradient(to right, #3b82f6, #062557);
        }

        /* ===============================
           GRID
        =============================== */
        .news-grid {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 1.5rem;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 2rem;
        }

        /* ===============================
           CARD
        =============================== */
        .news-card {
            background: #ffffff;
            border-radius: 1.25rem;
            overflow: hidden;
            box-shadow: 0 10px 24px rgba(0, 0, 0, 0.06);
            transition: all .35s ease;
            display: flex;
            flex-direction: column;
            height: 100%;
        }

        .news-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 24px 48px rgba(0, 0, 0, 0.12);
        }

        .news-image {
            height: 190px;
            overflow: hidden;
            background: #e5e7eb;
        }

        .news-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform .5s ease;
        }

        .news-card:hover img {
            transform: scale(1.08);
        }

        .news-content {
            padding: 1.5rem 1.5rem 1.75rem;
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .news-date {
            font-size: .75rem;
            letter-spacing: .03em;
            color: #64748b;
            margin-bottom: .5rem;
        }

        .news-title {
            font-size: 1.05rem;
            font-weight: 600;
            color: #0f172a;
            margin-bottom: .6rem;
            line-height: 1.45;
        }

        .news-excerpt {
            font-size: .95rem;
            color: #475569;
            line-height: 1.6;
            margin-bottom: auto;
        }

        .news-link {
            margin-top: 1.25rem;
            font-weight: 600;
            font-size: .9rem;
            color: #1d4ed8;
            text-decoration: none;
            transition: color .3s ease;
        }

        .news-link:hover {
            color: #062557;
        }

        .news-empty {
            grid-column: 1 / -1;
            text-align: center;
            color: #64748b;
        }

        /* ===============================
           CTA
        =============================== */
        .news-cta {
            text-align: center;
            margin-top: 3.5rem;
        }

        .news-cta-btn {
            display: inline-block;
            padding: .85rem 2.25rem;
            border-radius: 999px;
            background: linear-gradient(to right, #2563eb, #062557);
            color: #ffffff;
            font-weight: 600;
            text-decoration: none;
            box-shadow: 0 12px 30px rgba(37, 99, 235, .35);
            transition: all .35s ease;
        }

        .news-cta-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 20px 48px rgba(37, 99, 235, .45);
        }

        /* ===============================
           MOBILE
        =============================== */
        @media (max-width: 768px) {
            .hide-mobile {
                display: none;
            }

            .news-section {
                padding: 4rem 0;
            }

            .news-header {
                margin-bottom: 2.5rem;
            }
        }
    </style>

</section>
