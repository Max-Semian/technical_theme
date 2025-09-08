let markerAnim = ".marker-anim";

$(document).ready(function () {
  $(markerAnim).addClass("need-anim-pulse");
  animElements();

  $(window).on("scroll", function () {
    animElements();
  });

  $(".lang-switcher .current-lang").on("click", function () {
    $(this).parent(".lang-switcher").toggleClass("active");
  });

  $(".main-menu-desc li.has-submenu span").on("click", function () {
    let cuurentItem = $(this).parent("li.has-submenu");
    $(".main-menu-desc li.has-submenu").not(cuurentItem).removeClass("active");
    cuurentItem.toggleClass("active");
  });

  $(".main-menu-mob li.has-submenu span").on("click", function () {
    $(this).parent("li.has-submenu").toggleClass("active");
    if ($(this).parent("li.has-submenu").hasClass("active")) {
      $(".main-menu-mob ul").addClass("open-submenu-mob");
    } else {
      $(".main-menu-mob ul").removeClass("open-submenu-mob");
    }
  });

  $("#burg").on("click", function () {
    $("#pageCont").toggleClass("menu-open-mob");
  });

  $(".main-menu-mob").on("click", function (e) {
    if ($(e.target).closest(".main-menu-mob ul").length) return;
    $("#pageCont").removeClass("menu-open-mob");
  });

  $(document).click(function (e) {
    if ($(e.target).closest(".main-menu-desc li.has-submenu span").length) {
      $(".lang-switcher").removeClass("active");
      $(".slots-filters .filter-item").removeClass("active");
      return;
    }
    if ($(e.target).closest(".lang-switcher .current-lang").length) {
      $(".main-menu-desc li.has-submenu").removeClass("active");
      $(".slots-filters .filter-item").removeClass("active");
      return;
    }

    if (
      $(e.target).closest(".slots-filters .filter-item .filter-item-default")
        .length
    ) {
      $(".main-menu-desc li.has-submenu").removeClass("active");
      $(".lang-switcher").removeClass("active");
      return;
    }

    $(".lang-switcher").removeClass("active");
    $(".main-menu-desc li.has-submenu").removeClass("active");
    $(".slots-filters .filter-item").removeClass("active");
    e.stopPropagation();
  });

  $(".faq-item .faq-item-title").on("click", function () {
    let faqItem = $(this).parent(".faq-item");
    let faqItemInfo = $(faqItem).children(".faq-item-info");
    faqItem.toggleClass("active");

    if (faqItem.hasClass("active")) {
      faqItemInfo.stop().slideDown();
    } else {
      faqItemInfo.stop().slideUp();
    }
  });

  $(".rating.rating-buttons li").on("click", function () {
    let clickedIndex = $(this).index();
    let ratingButtons = $(this).parent(".rating-buttons");

    let hasStarActiveLast = ratingButtons
      .find(".star.active")
      .parent()
      .last()
      .index();
    ratingButtons.find(".star").removeClass("active");

    ratingButtons.children("li").each(function (index, item) {
      if (clickedIndex !== hasStarActiveLast) {
        if (index <= clickedIndex) {
          $(item).find(".star").addClass("active");
        }
      }
    });

    let activeStarsCount = ratingButtons.find(".star.active").length;
    ratingButtons.parent().find("input[name='stars']").val(activeStarsCount);
  });

  $(".slots-filters .filter-item .filter-item-default").on(
    "click",
    function () {
      $(".slots-filters .filter-item")
        .not($(this).parent(".filter-item"))
        .removeClass("active");
      $(this).parent().toggleClass("active");
    }
  );
});

function animElements() {
  let markersAnimCheck = inWindow(markerAnim);
  markersAnimCheck.addClass("active");
}

function inWindow(s) {
  var scrollTop = $(window).scrollTop();
  var windowHeight = $(window).height();
  var currentEls = $(s);
  var result = [];
  currentEls.each(function () {
    var el = $(this);
    var offset = el.offset();
    if (
      scrollTop <= offset.top &&
      el.height() / 4 + offset.top < scrollTop + windowHeight
    )
      result.push(this);
  });
  return $(result);
}



// ============== ВИДЕО ДЛЯ ГАЛЕРЕИ==================================
document.addEventListener("DOMContentLoaded", function () {
  const items = document.querySelectorAll(".block-news-previews .item");

  items.forEach((item) => {
    item.addEventListener("click", function () {
      const videoId = this.getAttribute("data-video-id");
      if (!videoId) return;

      const iframe = document.createElement("iframe");
      iframe.setAttribute(
        "src",
        "https://www.youtube.com/embed/" + videoId + "?autoplay=1"
      );
      iframe.setAttribute("frameborder", "0");
      iframe.setAttribute("allow", "autoplay; encrypted-media");
      iframe.setAttribute("allowfullscreen", "true");
      iframe.style.width = "100%";
      iframe.style.height = "100%";

      this.innerHTML = ""; // Очищаем превью
      this.appendChild(iframe);
    });
  });
});

// ============== ВИДЕО ДЛЯ ГАЛЕРЕИ==================================

//  jQuery(document).ready(function($) {
//   var btn = $('.btn-play');
//   var boxGame = $('#boxGame');
//   var iframe = $('#gameIframe');
//   var iframeSrc = 'https://3oaks.com/api/v1/games/sun_of_egypt_3/play?lang=en';
//   var blockReviewHead = $('.block-review-head');
//   var infoStat = $('.info-stat');

//   btn.on('click', function(event) {
//     event.preventDefault();
//     console.log('Клик по кнопке работает!');

//     iframe.attr('src', '');

//     var windowWidth = $(window).width();
//     blockReviewHead.children().not(boxGame).not(infoStat).hide();
//     if (windowWidth >= 650) {
//       infoStat.hide();
//     }
//     boxGame.show();

//     iframe.attr('src', iframeSrc);
//   });

//   $(window).on('scroll', function() {
//     var boxGameBottom = boxGame.offset().top + boxGame.outerHeight();
//     var windowTop = $(window).scrollTop();

//     if (boxGameBottom <= windowTop) {
//       boxGame.addClass('hidden');
//       boxGame.hide();
//       infoStat.show();
//       blockReviewHead.children().not(boxGame).not(infoStat).show();
//       iframe.attr('src', '');
//     } else {
//       boxGame.removeClass('hidden');
//     }
//   });
// });

jQuery(document).ready(function($) {
  var btn = $('#btnPlay');
  var boxGame = $('#boxGames');
  var iframe = $('#gameIframe');
  var blockReviewHead = $('#blockReviewHead');
  var infoStat = $('.info-stat');

  btn.on('click', function(event) {
    event.preventDefault();
    console.log('Клик по кнопке работает!');

    var windowWidth = $(window).width();
    blockReviewHead.children().not(boxGame).not(infoStat).hide();
    if (windowWidth >= 650) {
      infoStat.hide();
    }

    boxGame.show(); // просто показываем блок с iframe
  });

  $(window).on('scroll', function() {
  if (boxGame.length) {
    var offset = boxGame.offset();
    if (offset) {
      var boxGameBottom = offset.top + boxGame.outerHeight();
      var windowTop = $(window).scrollTop();

      if (boxGameBottom <= windowTop) {
        boxGame.addClass('hidden').hide();
        infoStat.show();
        blockReviewHead.children().not(boxGame).not(infoStat).show();
      } else {
        boxGame.removeClass('hidden');
      }
    }
  }
});
	
	
	
	document.querySelectorAll('.more').forEach(arrow => {
  arrow.addEventListener('click', function(e) {
    e.stopPropagation(); // чтобы ссылка не сработала
    this.parentElement.classList.toggle('open');
  });
});




});

