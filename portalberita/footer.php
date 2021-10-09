	</div>

</div>

<footer>
		<div class="container bg-white">
			<div class="py-3 my-5 text-center">
				Copyright &copy; 2021 | gercepnews.my.id
			</div>
		</div>
</footer>

<script>
	const swiper = new Swiper('.swiper', {
  // Optional parameters
  direction: 'horizontal',
  loop: true,
  autoplay: {
            delay: 2500,
             },
  // autoHeight: true,
  slidesPerView: 3,
	spaceBetween: 30,
	height : 40,
  // If we need pagination
  pagination: {
    el: '.swiper-pagination',
  },

  // Navigation arrows
  navigation: {
    nextEl: '.swiper-button-next',
    prevEl: '.swiper-button-prev',
  },
  breakpoints: {
        499: {
            slidesPerView: 1,
            spaceBetweenSlides: 30
        },
        1000: {
            slidesPerView: 2,
            spaceBetweenSlides: 40
        },
        1200: {
          slidesPerView: 3,
	        spaceBetweenSlides: 30
        },
    }

  // And if we need scrollbar

});
</script>
<script src="./controller/wow.min.js"></script>
<script>
new WOW().init();
</script>
</body>
</html>