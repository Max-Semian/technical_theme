// Проверка на существование элемента на странице
if (jQuery("#bonuses-block-2").length) {
    jQuery(document).ready(function ($) {
      let currentPage = 2;
      const button = $("#load-more-btn-block-2");
      const container = $("#bonuses-block-2");
      const postsPerPage = bonusBlock2Data.posts_per_page;
      const tagIds = bonusBlock2Data.tag_ids;
    
      button.on("click", function (e) {
        e.preventDefault();
    
        $.ajax({
          url: bonusBlock2Data.ajax_url,
          type: "POST",
          data: {
            action: "load_more_bonus_block_2",
            tag_ids: tagIds,
            page: currentPage,
            posts_per_page: postsPerPage,
          },
          success: function (response) {
            if ($.trim(response) !== "") {
              container.append(response);
              currentPage++;
            } else {
              button.hide();
            }
          },
        });
      });
    });
}