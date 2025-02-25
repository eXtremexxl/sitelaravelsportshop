@extends('layouts.app')

@php
    $isHome = true;
@endphp


@section('content')


<!-- Прелоадер -->
<div id="preloader">
    <div class="preloader-spinner">
        <div class="preloader-progress"></div>
        <span class="preloader-percent">0%</span>
    </div>
</div>



<!-- Главный экран -->
<section class="hero" id="hero">
    <div class="hero-background"></div> 
    <div class="hero-content">
        <h1>Сила в каждом движении</h1>
        <p>Premium спортивное питание для ваших побед</p>
        @auth
            <a href="{{ route('catalog') }}" class="cta-button">Начать сейчас</a>
        @else
            <a href="{{ route('login') }}" class="cta-button">Начать сейчас</a>
        @endauth
    </div>
</section>
<!-- ПОПУЛЯРНЫЕ КАТЕГОРИИ -->
<div class="sports-categories">
    <div class="sports-categories-container">
        <h2 class="sports-categories-title">Популярные категории</h2>
        <div class="sports-categories-grid">
            <div class="sports-category-column" data-aos="fade-up" data-aos-delay="100">
                <a href="/category/buds" class="sports-category-card">
                    <div class="sports-category-img">
                        <img src="img/buds.webp" alt="БАДы">
                    </div>
                    <h3>БАДы</h3>
                    <p>Витамины, минералы, добавки для здоровья и красоты</p>
                </a>
            </div>
            <div class="sports-category-column" data-aos="fade-up" data-aos-delay="200">
                <a href="/category/sport-pitanie" class="sports-category-card">
                    <div class="sports-category-img">
                        <img src="img/sport.webp" alt="Спортивное питание">
                    </div>
                    <h3>Спортивное питание</h3>
                    <p>Протеины, гейнеры, BCAA, добавки для снижения веса и прочее</p>
                </a>
            </div>
            <div class="sports-category-column" data-aos="fade-up" data-aos-delay="300">
                <a href="/category/dieticheskoye-pitanie" class="sports-category-card">
                    <div class="sports-category-img">
                        <img src="img/dieta.webp" alt="Диетическое питание">
                    </div>
                    <h3>Диетическое питание</h3>
                    <p>Сиропы, джемы, батончики, арахисовая паста</p>
                </a>
            </div>
            <div class="sports-category-column" data-aos="fade-up" data-aos-delay="400">
                <a href="/category/aksessuary" class="sports-category-card">
                    <div class="sports-category-img">
                        <img src="img/accsess.webp" alt="Аксессуары">
                    </div>
                    <h3>Аксессуары</h3>
                    <p>Шейкеры, бутылки, лямки, резинки и прочее</p>
                </a>
            </div>
        </div>
    </div>
</div>
<!-- ОСТАЛЬНОЕ -->
<section class="cloneable">
    <div class="looping-words">
        <div class="looping-words__containers">
            <ul data-looping-words-list="" class="looping-words__list">
                <li class="looping-words__list">
                    <p class="looping-words__p">Выносливость</p>
                </li>
                <li class="looping-words__list">
                    <p class="looping-words__p">Рельеф</p>
                </li>
                <li class="looping-words__list">
                    <p class="looping-words__p">Энергия</p>
                </li>
                <li class="looping-words__list">
                    <p class="looping-words__p">Сила</p>
                </li>
                <li class="looping-words__list">
                    <p class="looping-words__p">Восстановление</p>
                </li>
            </ul>
        </div>
        <div class="looping-words__fade"></div>
        <div data-looping-words-selector="" class="looping-words__selector">
            <div class="looping-words__edge"></div>
            <div class="looping-words__edge is--2"></div>
            <div class="looping-words__edge is--3"></div>
            <div class="looping-words__edge is--4"></div>
        </div>
    </div>
</section>

<!-- ХИТЫ ПРОДАЖ -->
<section class="best-sellers">
    <div class="best-sellers-container">
        <h2 class="best-sellers-title">Хиты продаж</h2>
        <div class="best-sellers-grid">
            @foreach($bestSellers as $index => $product)
                <div class="best-seller-card" data-aos="zoom-in" data-aos-delay="{{ $index * 100 }}">
                    <div class="best-seller-img">
                        <a href="{{ route('product', $product->slug) }}">
                            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}">
                        </a>
                    </div>
                    <h3>{{ $product->name }}</h3>
                    <p class="price">{{ number_format($product->price, 2) }} ₽</p>
                    <a href="{{ route('product', $product->slug) }}" class="buy-button">🛒 Купить</a>
                </div>
            @endforeach
        </div>
    </div>
</section>

<!-- ПРЕИМУЩЕСТВА
<section class="benefits">
    <div class="container2">
        <h2 class="section-title">Почему выбирают нас?</h2>
        <div class="benefits-grid">
            <div class="benefit-card" data-aos="flip-left" data-aos-delay="100">
                <div class="icon">
                    <img src="{{ asset('img/delivery.svg') }}" alt="Быстрая доставка">
                </div>
                <h3>Быстрая доставка</h3>
                <p>Доставляем за 1-3 дня по всей России, работаем с надежными курьерскими службами.</p>
            </div>
            <div class="benefit-card" data-aos="flip-left" data-aos-delay="200">
                <div class="icon">
                    <img src="{{ asset('img/quality.svg') }}" alt="100% качество">
                </div>
                <h3>100% качество</h3>
                <p>Только сертифицированные товары от официальных поставщиков, никаких подделок.</p>
            </div>
            <div class="benefit-card" data-aos="flip-left" data-aos-delay="300">
                <div class="icon">
                    <img src="{{ asset('img/support.svg') }}" alt="Поддержка 24/7">
                </div>
                <h3>Поддержка 24/7</h3>
                <p>Наши эксперты всегда на связи и помогут выбрать идеальный продукт.</p>
            </div>
        </div>
    </div>
</section> -->

<!-- НАШИ ПРЕИМУЩЕСТВА -->
<section class="advantages">
    <div class="advantages-container">
        <div class="advantages-content">
            <h2 class="advantages-title">Премиум качество</h2>
            <div class="advantages-layout">
                <div class="advantages-icon" id="advantages-icon">
                    <img src="{{ asset('img/dreamsport.png') }}" alt="Гантели" class="advantages-icon-img">
                </div>
                <div class="advantages-text">
                    <h3 class="advantages-subtitle">Наши преимущества</h3>
                    <ul class="advantages-list">
                        <li>Оригинальная продукция</li>
                        <li>Быстрая доставка</li>
                        <li>Собственное производство</li>
                        <li>Большой выбор</li>
                        <li>Доступные цены</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>


@if(isset($isHome) && $isHome)
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var navbar = document.querySelector(".navbar-light");
            if (document.body.classList.contains("homepage")) {
                window.addEventListener("scroll", function() {
                    if (window.scrollY > 50) {
                        navbar.classList.add("scrolled");
                    } else {
                        navbar.classList.remove("scrolled");
                    }
                });
            }
        });

        window.addEventListener('load', function() {
            const preloader = document.getElementById('preloader');
            const progressCircle = document.querySelector('.preloader-progress');
            const progressText = document.querySelector('.preloader-percent');
            const images = document.querySelectorAll('img');
            let loadedImages = 0;
            
            function updateProgress() {
                const progress = Math.round((loadedImages / images.length) * 100);
                progressCircle.style.setProperty('--progress', `${progress}%`);
                progressText.textContent = `${progress}%`;
                
                if (loadedImages === images.length) {
                    gsap.to(preloader, {
                        opacity: 0,
                        duration: 0.5,
                        delay: 0.3,
                        onComplete: () => {
                            preloader.style.display = 'none';
                        }
                    });
                }
            }

            function checkImageLoad() {
                loadedImages++;
                updateProgress();
            }

            if (images.length === 0) {
                progressCircle.style.setProperty('--progress', '100%');
                progressText.textContent = '100%';
                gsap.to(preloader, {
                    opacity: 0,
                    duration: 0.5,
                    onComplete: () => {
                        preloader.style.display = 'none';
                    }
                });
            } else {
                images.forEach(img => {
                    if (img.complete) {
                        checkImageLoad();
                    } else {
                        img.addEventListener('load', checkImageLoad);
                        img.addEventListener('error', checkImageLoad);
                    }
                });
            }
        });

        document.addEventListener('DOMContentLoaded', function() {
            const wordList = document.querySelector('[data-looping-words-list]');
            const words = Array.from(wordList.children);
            const totalWords = words.length;
            const wordHeight = 100 / totalWords;
            const edgeElement = document.querySelector('[data-looping-words-selector]');
            let currentIndex = 0;

            function updateEdgeWidth() {
                const centerIndex = (currentIndex + 1) % totalWords;
                const centerWord = words[centerIndex];
                const centerWordWidth = centerWord.getBoundingClientRect().width;
                const listWidth = wordList.getBoundingClientRect().width;
                const percentageWidth = (centerWordWidth / listWidth) * 100;
                gsap.to(edgeElement, {
                    width: `${percentageWidth}%`,
                    duration: 0.5,
                    ease: 'Expo.easeOut',
                });
            }

            function moveWords() {
                currentIndex++;
                gsap.to(wordList, {
                    yPercent: -wordHeight * currentIndex,
                    duration: 1.2,
                    ease: 'elastic.out(1, 0.85)',
                    onStart: updateEdgeWidth,
                    onComplete: function() {
                        if (currentIndex >= totalWords - 3) {
                            wordList.appendChild(wordList.children[0]);
                            currentIndex--;
                            gsap.set(wordList, { yPercent: -wordHeight * currentIndex });
                            words.push(words.shift());
                        }
                    }
                });
            }

            updateEdgeWidth();
            gsap.timeline({ repeat: -1, delay: 1 })
                .call(moveWords)
                .to({}, { duration: 2 })
                .repeat(-1);
        });




        document.addEventListener('DOMContentLoaded', function() {
    const icon = document.querySelector('.advantages-icon-img');

    icon.addEventListener('mousemove', (e) => {
        const rect = icon.getBoundingClientRect();
        const centerX = rect.left + rect.width / 2;
        const centerY = rect.top + rect.height / 2;
        const mouseX = e.clientX - centerX;
        const mouseY = e.clientY - centerY;

        // Лёгкое покачивание (смещение и небольшой наклон)
        const maxTranslate = 50; // Максимальное смещение в пикселях
        const maxRotation = 2; // Уменьшенный угол наклона

        const translateX = (mouseX / rect.width) * maxTranslate;
        const translateY = (mouseY / rect.height) * maxTranslate;
        const rotationX = (mouseY / rect.height) * maxRotation;
        const rotationY = (mouseX / rect.width) * -maxRotation;

        gsap.to(icon, {
            x: translateX,
            y: translateY,
            rotationX: rotationX,
            rotationY: rotationY,
            duration: 0.3,
            ease: 'power2.out'
        });
    });

    icon.addEventListener('mouseleave', () => {
        gsap.to(icon, {
            x: 0,
            y: 0,
            rotationX: 0,
            rotationY: 0,
            duration: 0.5,
            ease: 'power2.out'
        });
    });
}); 
    </script>
@endif

@endsection