if (typeof jQuery === "undefined") {
  throw new Error("AdminLTE requires jQuery");
}
'use strict';
$.AdminLTE = {};
$.AdminLTE.options = {
  navbarMenuSlimscroll: true,
  navbarMenuSlimscrollWidth: "3px", 
  navbarMenuHeight: "200px", 
  sidebarToggleSelector: "[data-toggle='offcanvas']",
  sidebarPushMenu: true,
  sidebarSlimScroll: true,
  enableBoxRefresh: true,
  enableBSToppltip: true,
  BSTooltipSelector: "[data-toggle='tooltip']",
  enableFastclick: true,
  enableBoxWidget: true,
  boxWidgetOptions: {
    boxWidgetIcons: {
      collapse: 'fa fa-minus',
      open: 'fa fa-plus',
      remove: 'fa fa-times'
    },
    boxWidgetSelectors: {
      remove: '[data-widget="remove"]',
      collapse: '[data-widget="collapse"]'
    }
  },
  colors: {
    lightBlue: "#3c8dbc",
    red: "#f56954",
    green: "#00a65a",
    aqua: "#00c0ef",
    yellow: "#f39c12",
    blue: "#0073b7",
    navy: "#001F3F",
    teal: "#39CCCC",
    olive: "#3D9970",
    lime: "#01FF70",
    orange: "#FF851B",
    fuchsia: "#F012BE",
    purple: "#8E24AA",
    maroon: "#D81B60",
    black: "#222222",
    gray: "#d2d6de"
  }
};
$(function () {
  var o = $.AdminLTE.options;
  $.AdminLTE.layout.activate();
  $.AdminLTE.tree('.sidebar');
  if (o.navbarMenuSlimscroll && typeof $.fn.slimscroll != 'undefined') {
    $(".navbar .menu").slimscroll({
      height: "200px",
      alwaysVisible: false,
      size: "3px"
    }).css("width", "100%");
  }
  if (o.sidebarPushMenu) {
    $.AdminLTE.pushMenu(o.sidebarToggleSelector);
  }
  if (o.enableBSToppltip) {
    $(o.BSTooltipSelector).tooltip();
  }
  if (o.enableBoxWidget) {
    $.AdminLTE.boxWidget.activate();
  }
  if(o.enableFastclick && typeof FastClick != 'undefined') {
    FastClick.attach(document.body);
  }
  $('.btn-group[data-toggle="btn-toggle"]').each(function () {
    var group = $(this);
    $(this).find(".btn").click(function (e) {
      group.find(".btn.active").removeClass("active");
      $(this).addClass("active");
      e.preventDefault();
    });
  });
});
$.AdminLTE.layout = {
  activate: function () {
    var _this = this;
    _this.fix();
    _this.fixSidebar();
    $(window, ".wrapper").resize(function () {
      _this.fix();
      _this.fixSidebar();
    });
  },
  fix: function () {
    var neg = $('.main-header').outerHeight() + $('.main-footer').outerHeight();
    var window_height = $(window).height();
    var sidebar_height = $(".sidebar").height();
    if ($("body").hasClass("fixed")) {
      $(".content-wrapper, .right-side").css('min-height', window_height - $('.main-footer').outerHeight());
    } else {
      if (window_height >= sidebar_height) {
        $(".content-wrapper, .right-side").css('min-height', window_height - neg);
      } else {
        $(".content-wrapper, .right-side").css('min-height', sidebar_height);
      }
    }
  },
  fixSidebar: function () {
    if (!$("body").hasClass("fixed")) {
      if (typeof $.fn.slimScroll != 'undefined') {
        $(".sidebar").slimScroll({destroy: true}).height("auto");
      }
      return;
    } else if (typeof $.fn.slimScroll == 'undefined' && console) {
      console.error("Error: the fixed layout requires the slimscroll plugin!");
    }
    if ($.AdminLTE.options.sidebarSlimScroll) {
      if (typeof $.fn.slimScroll != 'undefined') {
        $(".sidebar").slimScroll({destroy: true}).height("auto");
        $(".sidebar").slimscroll({
          height: ($(window).height() - $(".main-header").height()) + "px",
          color: "rgba(0,0,0,0.2)",
          size: "3px"
        });
      }
    }
  }
};
$.AdminLTE.pushMenu = function (toggleBtn) {
  $(toggleBtn).click(function (e) {
    e.preventDefault();
    $("body").toggleClass('sidebar-collapse');
    $("body").toggleClass('sidebar-open');
  });
  $(".content-wrapper").click(function () {
    if ($(window).width() <= 767 && $("body").hasClass("sidebar-open")) {
      $("body").removeClass('sidebar-open');
    }
  });
};
$.AdminLTE.tree = function (menu) {
  $("li a", $(menu)).click(function (e) {
    var $this = $(this);
    var checkElement = $this.next();
    if ((checkElement.is('.treeview-menu')) && (checkElement.is(':visible'))) {
      checkElement.slideUp('normal', function () {
        checkElement.removeClass('menu-open');
      });
      checkElement.parent("li").removeClass("active");
    }
    else if ((checkElement.is('.treeview-menu')) && (!checkElement.is(':visible'))) {
      var parent = $this.parents('ul').first();
      var ul = parent.find('ul:visible').slideUp('normal');
      ul.removeClass('menu-open');
      var parent_li = $this.parent("li");
      checkElement.slideDown('normal', function () {
        checkElement.addClass('menu-open');
        parent.find('li.active').removeClass('active');
        parent_li.addClass('active');
      });
    }
    if (checkElement.is('.treeview-menu')) {
      e.preventDefault();
    }
  });
};
$.AdminLTE.boxWidget = {
  activate: function () {
    var o = $.AdminLTE.options;
    var _this = this;
    $(o.boxWidgetOptions.boxWidgetSelectors.collapse).click(function (e) {
      e.preventDefault();
      _this.collapse($(this));
    });
    $(o.boxWidgetOptions.boxWidgetSelectors.remove).click(function (e) {
      e.preventDefault();
      _this.remove($(this));
    });
  },
  collapse: function (element) {
    var box = element.parents(".box").first();
    var bf = box.find(".box-body, .box-footer");
    if (!box.hasClass("collapsed-box")) {
      element.children(".fa-minus").removeClass("fa-minus").addClass("fa-plus");
      bf.slideUp(300, function () {
        box.addClass("collapsed-box");
      });
    } else {
      element.children(".fa-plus").removeClass("fa-plus").addClass("fa-minus");
      bf.slideDown(300, function () {
        box.removeClass("collapsed-box");
      });
    }
  },
  remove: function (element) {
    var box = element.parents(".box").first();
    box.slideUp();
  },
  options: $.AdminLTE.options.boxWidgetOptions
};
(function ($) {
  $.fn.boxRefresh = function (options) {
    var settings = $.extend({
      trigger: ".refresh-btn",
      source: "",
      onLoadStart: function (box) {
      }, 
      onLoadDone: function (box) {
      } 
    }, options);
    var overlay = $('<div class="overlay"></div><div class="loading-img"></div>');
    return this.each(function () {
      if (settings.source === "") {
        if (console) {
          console.log("Please specify a source first - boxRefresh()");
        }
        return;
      }
      var box = $(this);
      var rBtn = box.find(settings.trigger).first();
      rBtn.click(function (e) {
        e.preventDefault();
        start(box);
        box.find(".box-body").load(settings.source, function () {
          done(box);
        });
      });
    });
    function start(box) {
      box.append(overlay);
      settings.onLoadStart.call(box);
    }
    function done(box) {
      box.find(overlay).remove();
      settings.onLoadDone.call(box);
    }
  };
})(jQuery);
(function ($) {
  $.fn.todolist = function (options) {
    var settings = $.extend({
      onCheck: function (ele) {
      },
      onUncheck: function (ele) {
      }
    }, options);
    return this.each(function () {
      if (typeof $.fn.iCheck != 'undefined') {
        $('input', this).on('ifChecked', function (event) {
          var ele = $(this).parents("li").first();
          ele.toggleClass("done");
          settings.onCheck.call(ele);
        });
        $('input', this).on('ifUnchecked', function (event) {
          var ele = $(this).parents("li").first();
          ele.toggleClass("done");
          settings.onUncheck.call(ele);
        });
      } else {
        $('input', this).on('change', function (event) {
          var ele = $(this).parents("li").first();
          ele.toggleClass("done");
          settings.onCheck.call(ele);
        });
      }
    });
  };
}(jQuery));
