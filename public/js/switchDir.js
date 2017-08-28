app.directive('switchDir', function ($timeout) {
    return {
        link: function (scope, element, attrs) {
            var sw = new Switchery(element.get(0), {
                color: null != element.data("color") ? $.Pages.getColor(element.data("color")) : $.Pages.getColor("success"), size: null != element.data("size") ? element.data("size") : "default"});
        }
    }
});