@extends('frontend.layouts.app')
@section('title', 'Home | News AI')
@section('content')

    <section class="signup_content">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
            <form id="hero" class="hero" method="POST" action="">
            @csrf
            <p class="landing_description">
                <span>△</span>
            </p>
            <div class="landing-header text-center">
                <span class="tagline">Welcome to</span>
                <h1 class="brand" translate="no">News<span class="brand_ai">AI</span></h1>
                <span class="tagline">Your World. Your News.</span>
            </div>
            <p class="landing_description"> Stay wise, choose wisely</p>
            <div class="landing-buttons">
            <!-- <a href="{{ route('register') }}" class="btn btn-primary">
        Create my newsletter
        <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>
            </a> -->
                @if(session('success'))
                    <p class="text-success mt-4 text-center">{{ session('success') }}</p>
                @endif

                @error('email')
                    <p class="text-success mt-4 text-center">{{ $message }}</p>
                @enderror
                <p class="spam-note">
                    <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path></svg>
                    No clutter, just value
                </p>
            </div>
        </form>
                </div>
            </div>
        </div>
    </section>

    <section class="why_news">
        <div class="container">
            <div class="why_news_wrapper">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="newsletter-benefits__header">
                            <h2 class="newsletter-benefits-title">Why NewsAI?</h2>
                            <p class="newsletter-benefits__description">See how NewsAI keeps you updated with a smart, easy-to-read newsletter.</p>
                            <div class="newsletter-benefits__cards">
                                <article class="newsletter-benefits__card">
                                    <span class="newsletter-benefits__icon">
                                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M12 3.5l2.2 4.5 5 0.7-3.6 3.5.8 5-4.4-2.4-4.4 2.4.8-5-3.6-3.5 5-.7z"></path></svg>
                                    </span>
                                    <div class="newsletter-benefits__card-content">
                                        <h3>Personalized for you</h3>
                                        <p> Not everyone wants the same news. NewsAI learns what you care about, so every day your news is made just for you.</p>
                                    </div>
                                </article>
                                <article class="newsletter-benefits__card mt-3">
                                    <span class="newsletter-benefits__icon">
                                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><line x1="4" y1="6" x2="10.5" y2="6"></line><line x1="15.5" y1="6" x2="20" y2="6"></line><circle cx="13" cy="6" r="2.5"></circle><line x1="4" y1="12" x2="8.5" y2="12"></line><line x1="13.5" y1="12" x2="20" y2="12"></line><circle cx="11" cy="12" r="2.5"></circle><line x1="4" y1="18" x2="12.5" y2="18"></line><line x1="17.5" y1="18" x2="20" y2="18"></line><circle cx="15" cy="18" r="2.5"></circle></svg>
                                    </span>
                                    <div class="newsletter-benefits__card-content">
                                        <h3>Many sources in one place</h3>
                                        <p>News is everywhere, but scattered. NewsAI brings different voices and opinions together, so you don’t have to visit hundreds of websites.</p>
                                    </div>
                                </article>
                                   <article class="newsletter-benefits__card mt-3">
                                    <span class="newsletter-benefits__icon">
                                      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M12 2.8l2.1 1.5 2.8.4 1.3 2.7 2.2 1.6-.3 2.9.3 2.9-2.2 1.6-1.3 2.7-2.8.4-2.1 1.5-2.1-1.5-2.8-.4-1.3-2.7-2.2-1.6.3-2.9-.3-2.9 2.2-1.6 1.3-2.7 2.8-.4z"></path><path d="m9 12 2.5 2.5L15.5 10"></path></svg>
                                    </span>
                                    <div class="newsletter-benefits__card-content">
                                        <h3>Made for you</h3>
                                        <p>No tricky algorithms or hidden motives. Staying informed is your choice. With NewsAI, you control what you read.</p>
                                    </div>
                                </article>
                            </div>
                            <div class="newsletter-benefits__footer mt-4">
                                <span class="newsletter-benefits__highlight newsletter-benefits__highlight--pace">
                                    <span class="newsletter-benefits__highlight-icon">
                                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="9"></circle><polyline points="12 7 12 12 16 14"></polyline></svg>
                                    </span>
                                    Go at your pace
                                </span>
                                <span class="newsletter-benefits__highlight newsletter-benefits__highlight--ai">
                                    <span class="newsletter-benefits__highlight-icon">
                                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="13 2 3 14 12 14 11 22 21 10 13 10 13 2"></polyline></svg>
                                    </span>
                                    AI-powered
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="how-it-works">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="how_it_works_wrapper">
                        <div class="how-it-works__header">
                            <h2>How it works?</h2>
                            <p>With NewsAI, staying updated is easy. Pick what matters to you, decide how you want to see it, and find all your news in one place.</p>
                        </div>
                        <div class="how-it-works__cards">
                            <article class="how-it-works__card mt-3">
                                <span class="how-it-works__icon">
                                    <svg viewBox="0 0 40 40" fill="none" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><circle cx="20" cy="20" r="17" stroke="currentColor"></circle><text x="50%" y="50%" text-anchor="middle" dominant-baseline="central" font-size="16" fill="currentColor" font-family="inherit">1</text></svg>
                                </span>
                                <div class="how-it-works__card-content">
                                    <h3>Choose your topics</h3>
                                    <p>Select the things you care about. Your news feed will be made just for you.</p>
                                </div>
                            </article>
                            <article class="how-it-works__card mt-2">
                                <span class="how-it-works__icon">
                                    <svg viewBox="0 0 40 40" fill="none" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><circle cx="20" cy="20" r="17" stroke="currentColor"></circle><text x="50%" y="50%" text-anchor="middle" dominant-baseline="central" font-size="16" fill="currentColor" font-family="inherit">2</text></svg>
                                </span>
                                <div class="how-it-works__card-content">
                                    <h3>Choose how to get it</h3>
                                    <p>Decide whether you want your news in emails, the app, or notifications.</p>
                                </div>
                            </article>
                            <article class="how-it-works__card mt-2">
                                <span class="how-it-works__icon">
                                    <svg viewBox="0 0 40 40" fill="none" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><circle cx="20" cy="20" r="17" stroke="currentColor"></circle><text x="50%" y="50%" text-anchor="middle" dominant-baseline="central" font-size="16" fill="currentColor" font-family="inherit">3</text></svg>
                                </span>
                                <div class="how-it-works__card-content">
                                    <h3>Everything in one place</h3>
                                    <p>All your news comes together so you don’t have to look everywhere.</p>
                                </div>
                            </article>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="mission-section">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="mission_lecture">
                        <h2>Our Mission</h2>
                        <p>
                            Journalism started with a clear goal: to share knowledge, help people make informed choices, and give everyone a voice. Long ago, newspapers made sure information was not only for a few people—they brought truth into every home. Journalism promised honesty, challenged those in power, and respected each person’s right to form their own opinion.
                        </p>
                        <p>
                           Over time, that promise got weaker. News became more about business and politics than about serving the public. What we read was often shaped by money, influence, or hidden agendas. Important facts got lost in noise, empty headlines, and private interests.
                        </p>
                        <p>
                            NewsAI was created to change this. We are not just another news source—we give you control. You decide what matters, whose voices you trust, and how you want to get your news. Our information comes from many sources, without anyone hiding or changing it, so you get clear and honest news.
                        </p>
                        <p>
                           Our mission is simple: bring back the true spirit of journalism. Serve the people, not power. Information is a right, not something to buy or sell. It belongs to all of us. It belongs to you.
                        </p>
                        <p class="mission-signature">—The NewsAI Team</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <footer class="auth-footer">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                <div class="auth-footer__content">
                <p translate="no">contact@onenews.ai</p>
                <p>© {{date('Y')}} NewsAi. All rights reserved.</p>
                </div>
                </div>
            </div>
        </div>
    </footer>
   
@endsection