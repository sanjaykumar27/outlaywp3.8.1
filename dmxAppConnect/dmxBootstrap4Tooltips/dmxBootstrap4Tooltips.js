dmx.Attribute('bs-tooltip', 'mounted', function(node, attr) {
  this.$addBinding(attr.value, function(value) {
    $(node).tooltip({
      placement: function(node) {
        var pexpression = node.getAttribute('dmx-bs-placement') || '';
        return dmx.parse(pexpression) || node.getAttribute('data-bs-placement') || 'auto';
      },
      title: function() {
        var expression = this.getAttribute('dmx-bs-tooltip') || '';
        return dmx.parse(expression) || this.getAttribute('tooltip-title') || this.getAttribute('title') || '';
      }
    });

    node.setAttribute('tooltip-title', value || '');
  })
});

$(function () {
  $('body').tooltip({
    selector: '[tooltip-title]:not([data-trigger])',
    trigger: 'hover',
    placement: function(node) {
      var pexpression = node.getAttribute('dmx-bs-placement') || '';
      return dmx.parse(pexpression) || node.getAttribute('data-bs-placement') || 'auto';
    },
    title: function() {
      var expression = this.getAttribute('dmx-bs-tooltip') || '';
      return dmx.parse(expression) || this.getAttribute('tooltip-title') || this.getAttribute('title') || '';
    }
  });
});
