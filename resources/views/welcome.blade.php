<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Deenia - Belajar Kisah Para Nabi</title>
    <link rel="stylesheet" href="{{ asset('assets/css/landing-page.css') }}">
</head>
<body>
    <div class="landing-page">
        <header class="site-header" id="home">
            <div class="container header-content">
                <a class="brand" href="#home" aria-label="Deenia">
                    <img src="{{ asset('assets/images/logo.webp') }}" alt="Logo Deenia">
                </a>

                <nav class="main-nav" aria-label="Navigasi utama">
                    <a href="#home">Home</a>
                    <a href="#tentang">About</a>
                </nav>

                @if (Route::has('login'))
                    <a class="login-button" href="{{ route('login') }}">Login</a>
                @else
                    <a class="login-button" href="#mulai">Mulai</a>
                @endif
            </div>
        </header>

        <main>
            <section class="hero-section">
                <div class="container hero-layout">
                    <div class="hero-mascot-wrap">
                        <img class="hero-mascot" src="{{ asset('assets/images/mascot-wave.webp') }}" alt="Maskot Deenia menyambut pengguna">
                    </div>

                    <div class="hero-card">
                        <div class="hero-copy">
                            <h1>Belajar Kisah Para Nabi dengan Cara yang Menyenangkan</h1>
                            <a class="primary-button" href="#mulai">Mulai Sekarang</a>
                        </div>
                    </div>
                </div>
            </section>

            <section class="about-section" id="tentang">
                <div class="container">
                    <div class="section-heading">
                        <p class="section-label">Tentang Deenia</p>
                        <h2>Deenia adalah platform pembelajaran interaktif yang membantu siswa memahami nilai keislaman para nabi melalui materi terstruktur, kuis interaktif, dan sistem progres belajar yang mudah dipahami.</h2>
                    </div>
                </div>
            </section>

            <section class="story-section" id="cerita">
                <div class="container story-grid">
                    <article class="feature-text">
                        <p class="section-label">Belajar dengan Cerita yang Menarik</p>
                        <h3>Cerita nabi disajikan secara ringan, runtut, dan mudah dibayangkan.</h3>
                        <p>Setiap materi dibuat untuk membantu anak mengenal keteladanan para nabi melalui bahasa yang dekat dengan keseharian.</p>
                    </article>

                    <div class="mascot-small mascot-curious">
                        <img src="{{ asset('assets/images/mascot-curious.webp') }}" alt="Maskot Deenia ingin tahu">
                    </div>
                </div>
            </section>

            <section class="quiz-section" id="quiz">
                <div class="container quiz-grid">
                    <div class="mascot-small mascot-quiz">
                        <img src="{{ asset('assets/images/mascot-sus.webp') }}" alt="Maskot Deenia berpikir memecahkan quiz">
                    </div>

                    <article class="feature-text">
                        <p class="section-label">Quiz Interaktif</p>
                        <h3>Uji pemahaman dengan tantangan yang ringan dan seru.</h3>
                        <p>Siswa menjawab pertanyaan, mengingat pesan utama, dan melihat perkembangan belajar setelah membaca kisah para nabi.</p>
                    </article>
                </div>
            </section>

            <section class="cta-section" id="mulai">
                <div class="container">
                    <div class="cta-card">
                        <h2>Mulai Perjalanan Menyusuri Kisah Para Nabi</h2>
                        <p>Pelajari kejujuran, kesabaran, keberanian, dan kasih sayang melalui kisah penuh hikmah yang mudah dipahami anak.</p>
                        @if (Route::has('register'))
                            <a class="primary-button" href="{{ route('register') }}">Daftar</a>
                        @else
                            <a class="primary-button" href="#home">Mulai</a>
                        @endif
                    </div>
                </div>
            </section>
        </main>

        <footer class="site-footer">
            <div class="container footer-content">
                <a class="footer-brand" href="#home" aria-label="Deenia">
                    <img src="{{ asset('assets/images/logo.webp') }}" alt="Logo Deenia">
                </a>
                <p>© {{ date('Y') }} Deenia. Belajar kisah para nabi dengan cara yang menyenangkan.</p>
            </div>
        </footer>
    </div>
</body>
</html>
