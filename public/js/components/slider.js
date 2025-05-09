class Slider {
  constructor(trackId, prevBtnId, nextBtnId) {
    this.track = document.getElementById(trackId);
    this.prevBtn = document.getElementById(prevBtnId);
    this.nextBtn = document.getElementById(nextBtnId);
    this.slides = this.track.children;
    this.totalSlides = this.slides.length;
    this.currentIndex = 0;
    this.autoSlideInterval = null;
    this.startX = 0;
    this.endX = 0;

    this.init();
  }

  init() {
    this.setupEventListeners();
    this.updateImageSources();
    this.startAutoSlide();
  }

  updateSlider(withTransition = true) {
    if (withTransition) {
      this.track.classList.add("transition", "duration-500", "ease-in-out");
    } else {
      this.track.classList.remove("transition", "duration-500", "ease-in-out");
    }

    this.track.style.transform = `translateX(-${this.currentIndex * 100}%)`;
  }

  prev() {
    if (this.currentIndex === 0) {
      this.stopAutoSlide();
      this.updateSlider(false);
      this.track.style.transform = `translateX(-${((this.currentIndex - 1 + this.totalSlides) % this.totalSlides) * 100}%)`;
      this.currentIndex = (this.currentIndex - 1 + this.totalSlides) % this.totalSlides;
    } else {
      this.stopAutoSlide();
      this.currentIndex = (this.currentIndex - 1 + this.totalSlides) % this.totalSlides;
      this.updateSlider(true);
    }
  }

  next() {
    if (this.currentIndex === this.totalSlides - 1) {
      this.stopAutoSlide();
      this.currentIndex = 0;
      this.updateSlider(false);
    } else {
      this.stopAutoSlide();
      this.currentIndex = (this.currentIndex + 1) % this.totalSlides;
      this.updateSlider(true);
    }
  }

  startAutoSlide() {
    this.autoSlideInterval = setInterval(() => {
      if (this.currentIndex === this.totalSlides - 1) {
        this.currentIndex = 0;
        this.updateSlider(false);
      } else {
        this.currentIndex = (this.currentIndex + 1) % this.totalSlides;
        this.updateSlider(true);
      }
    }, 3000);
  }

  stopAutoSlide() {
    clearInterval(this.autoSlideInterval);
  }

  handleSwipe() {
    const distance = this.endX - this.startX;
    if (distance > 50) {
      this.currentIndex = (this.currentIndex - 1 + this.totalSlides) % this.totalSlides;
      if (this.currentIndex === this.totalSlides - 1) {
        this.updateSlider(false);
      } else {
        this.updateSlider(true);
      }
    } else if (distance < -50) {
      this.currentIndex = (this.currentIndex + 1) % this.totalSlides;
      if (this.currentIndex === 0) {
        this.updateSlider(false);
      } else {
        this.updateSlider(true);
      }
    }
  }

  updateImageSources() {
    const isMobile = window.innerWidth < 768;
    const images = this.track.querySelectorAll("img");

    images.forEach((img, index) => {
      const imgIndex = index + 1;
      img.src = isMobile ? `./img/sliders/slide${imgIndex}-mb.jpg` : `./img/sliders/slide${imgIndex}-pc.jpg`;
    });
  }

  setupEventListeners() {
    // Touch events for mobile
    this.track.addEventListener("touchstart", (e) => {
      e.preventDefault();
      this.stopAutoSlide();
      this.startX = e.touches[0].clientX;
    });

    this.track.addEventListener("touchend", (e) => {
      e.preventDefault();
      this.startAutoSlide();
      this.endX = e.changedTouches[0].clientX;
      this.handleSwipe();
    });

    // Mouse events for desktop
    this.track.addEventListener("mousedown", (e) => {
      e.preventDefault();
      this.stopAutoSlide();
      this.startX = e.clientX;
      this.track.style.cursor = "grabbing";
    });

    this.track.addEventListener("mouseup", (e) => {
      e.preventDefault();
      this.startAutoSlide();
      this.endX = e.clientX;
      this.track.style.cursor = "grab";
      this.handleSwipe();
    });

    // Button events
    this.prevBtn.addEventListener("click", () => this.prev());
    this.nextBtn.addEventListener("click", () => this.next());

    // Window events
    window.addEventListener("resize", () => this.updateImageSources());
  }
}

// Export the Slider class
export default Slider;
