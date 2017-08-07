app.controller('GroupController', ['$scope', '$compile', '$window', function ($scope, $compile, $window) {

        $scope.id = $window.group ? $window.group.id : 'null';
        $scope.group = $window.group ? $window.group : null;
        $scope.programs = $window.programs;
        $scope.objs_ids = [];
        $scope.errors = [];

        $scope.processing = false;
        $scope.success = false;

        if ($scope.group) {
            angular.forEach($scope.group.objs, function (e, i) {
                $scope.objs_ids.push(e.id);
            });
        }

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $window.Laravel.csrfToken
            }
        });

        $scope.selectAll = function (id, $event) {
            if ($event.target.checked)
                $("input[name^='objs[" + id + "]']").prop('checked', true)
            else
                $("input[name^='objs[" + id + "]']").prop('checked', false)
        }

        $scope.processGroup = function () {
            $scope.processing = true;

            setTimeout(function () {
                $scope.$apply();
                $('html, body').animate({
                    scrollTop: $("#processing").offset().top
                }, 400);
            }, 100);

            $scope.errors = [];
            var data = new FormData($('#group_form')[0]);
            $.ajax({
                url: '/group/save',
                type: 'post',
                data: data,
                cache: false,
                contentType: false,
                processData: false,
                success: function (data) {
                    console.log(data);
                    $scope.processing = false;
                    $scope.success = true;
                    $scope.$apply();
                    $('html, body').animate({
                        scrollTop: $("#success").offset().top
                    }, 400);
                },
                error: function (e) {
                    $scope.processing = false;
                    console.log(e.responseText);
                    var obj = JSON.parse(e.responseText);

                    angular.forEach(obj, function (e, i) {
                        $scope.errors.push(e[0]);
                    });

                    $scope.$apply();
                    console.log($scope.errors);

                    $('html, body').animate({
                        scrollTop: 0
                    }, 400);
                },
            });
        }
    }]);