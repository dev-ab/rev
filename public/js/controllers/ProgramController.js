app.controller('ProgramController', ['$scope', '$compile', '$window', function ($scope, $compile, $window) {

        $scope.id = $window.program ? $window.program.id : 'null';
        $scope.program = $window.program ? $window.program : null;
        $scope.objs = $window.program ? $window.program.objs : [{id: 'null'}];
        $scope.errors = [];

        $scope.processing = false;
        $scope.success = false;


        $scope.addObj = function () {
            $scope.objs.push({id: 'null'});
        }

        $scope.rmObj = function (index) {
            $scope.objs.splice(index, 1);
        }

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $window.Laravel.csrfToken
            }
        });

        $scope.processProgram = function () {
            $scope.processing = true;

            setTimeout(function () {
                $scope.$apply();
                $('html, body').animate({
                    scrollTop: $("#processing").offset().top
                }, 400);
            }, 100);

            $scope.errors = [];
            var data = new FormData($('#program_form')[0]);
            $.ajax({
                url: '/program/save',
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