$(document).ready (function () {

  $("a[title], input[title], span[title]").qtip({
    style: {
      classes: 'ui-tooltip-dark'
    },
    position: {
      my: 'bottom middle',
      at: 'top middle',
      adjust: {
        y: -7
      }
    },
    show: { delay: 300 }
  });

});