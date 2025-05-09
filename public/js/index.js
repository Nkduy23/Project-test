import Slider from "./components/slider.js";

// Khởi tạo slider khi DOM đã load
document.addEventListener("DOMContentLoaded", () => {
  const mySlider = new Slider("sliderTrack", "prevBtn", "nextBtn");

  // Bạn có thể truy cập các phương thức từ bên ngoài nếu cần
  // Ví dụ:
  // document.getElementById('customPrevBtn').addEventListener('click', () => mySlider.prev());
});
