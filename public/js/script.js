    document.addEventListener("DOMContentLoaded", function () {
      // Плавный скролл
      document.querySelectorAll('a[href^="#"]').forEach(anchor => {
          anchor.addEventListener("click", function (e) {
              e.preventDefault();
              const target = document.querySelector(this.getAttribute("href"));
              if (target) {
                  window.scrollTo({
                      top: target.offsetTop - 50,
                      behavior: "smooth"
                  });
              }
          });
      });
  
      // Анимация появления секций при прокрутке
      const sections = document.querySelectorAll("section, .sports-categories, .best-sellers, .benefits");
      const options = { threshold: 0.2 };
  
      const observer = new IntersectionObserver((entries) => {
          entries.forEach(entry => {
              if (entry.isIntersecting) {
                  entry.target.classList.add("visible");
              }
          });
      }, options);
  
      sections.forEach(section => {
          observer.observe(section);
          section.classList.add("hidden");
      });
  
      // Эффект наведения на карточки
      document.querySelectorAll(".sports-category-card, .best-seller-card, .benefit-card").forEach(card => {
          card.addEventListener("mouseenter", () => {
              card.style.transform = "scale(1.05)";
              card.style.transition = "transform 0.3s ease";
          });
          card.addEventListener("mouseleave", () => {
              card.style.transform = "scale(1)";
          });
      });
  
      // Параллакс-эффект для hero
      window.addEventListener("scroll", function () {
          let scrollPos = window.scrollY;
          let hero = document.querySelector(".hero");
          if (hero) {
              hero.style.backgroundPositionY = `${scrollPos * 0.5}px`;
          }
      });
  });
  
  // Добавляем стили для анимации и параллакса
  window.addEventListener('scroll', () => {
      const heroBackground = document.querySelector('.hero-background');
      const scrollPosition = window.pageYOffset;
      
      // Плавное движение фона (можно настроить коэффициент 0.3)
      heroBackground.style.transform = `translateY(${scrollPosition * 0.7}px)`;
  });
  

  window.addEventListener("load", function () {
    const heroBg = document.querySelector(".hero-background");
    if (heroBg) {
        heroBg.style.opacity = "1";
    }
});


