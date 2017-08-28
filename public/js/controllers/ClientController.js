app.controller('ClientController', ['$scope', '$compile', '$window', function ($scope, $compile, $window) {

        //contacts arrays
        $scope.id = $window.client ? $window.client.id : 'null';
        $scope.client = $window.client ? $window.client : null;
        $scope.company_phones = $window.client ?
                $window.client.phones.length > 0 ? $window.client.phones : [{id: 'null'}]
                : [{id: 'null'}];
        $scope.company_faxes = $window.client ?
                $window.client.faxes.length > 0 ? $window.client.faxes : [{id: 'null'}]
                : [{id: 'null'}];
        $scope.company_emails = $window.client ?
                $window.client.emails.length > 0 ? $window.client.emails : [{id: 'null'}]
                : [{id: 'null'}];
        $scope.company_websites = $window.client ?
                $window.client.websites.length > 0 ? $window.client.websites : [{id: 'null'}]
                : [{id: 'null'}];
        //partners
        $scope.partners = $window.client ?
                $window.client.partners.length > 0 ? $window.client.partners : [{id: 'null'}]
                : [{id: 'null'}];
        //representativs
        $scope.representatives = $window.client ?
                $window.client.reps.length > 0 ? $window.client.reps : [{id: 'null'}]
                : [{id: 'null'}];
        //auditors
        $scope.auditors = $window.client ?
                $window.client.auditors.length > 0 ? $window.client.auditors : [{id: 'null'}]
                : [{id: 'null'}];
        //view attachments
        $scope.view_attachments = $window.client ?
                $window.client.attachments.length > 0 ? $window.client.attachments : []
                : [];
        //attachments
        $scope.attachments = [
            {name: 'شعار الشركة'},
            {name: 'نسخة القوائم المالية للسنة السابقة'},
            {name: 'التعميد بالعمل'},
            {name: 'فاكس المراجع السابق'},
            {name: 'خطاب الافصاح'},
            {name: 'عقود الايجار الدائمة'},
            {name: 'عقود التسهيلات والقروض'},
            {name: 'صكوك الأراضي'},
            {name: 'عقود الموردين الدائمين'},
            {name: 'عقود العملاء طويلة الاجل'},
            {name: 'القوائم المالية الحالية'},
            {name: 'السجل التجارى'},
            {name: 'عقد التأسيس'},
            {name: 'آخر شهادة زكاه'},
            {name: ''},
        ]

        $scope.errors = [];

        $scope.processing = false;
        $scope.success = false;


        $scope.addContact = function (type) {
            if (type === 'phone')
                $scope.company_phones.push({id: 'null'});
            else if (type === 'fax')
                $scope.company_faxes.push({id: 'null'});
            else if (type === 'email')
                $scope.company_emails.push({id: 'null'});
            else if (type === 'website')
                $scope.company_websites.push({id: 'null'});
        }

        $scope.rmContact = function (type) {
            if (type === 'phone')
                $scope.company_phones.splice(-1, 1);
            else if (type === 'fax')
                $scope.company_faxes.splice(-1, 1);
            else if (type === 'email')
                $scope.company_emails.splice(-1, 1);
            else if (type === 'website')
                $scope.company_websites.splice(-1, 1);
        }

        $scope.addPartner = function () {
            $scope.partners.push({id: 'null'});
        }

        $scope.rmPartner = function (type) {
            $scope.partners.splice(-1, 1);
        }

        $scope.addRep = function () {
            $scope.representatives.push({id: 'null'});
        }

        $scope.rmRep = function (type) {
            $scope.representatives.splice(-1, 1);
        }

        $scope.addAud = function () {
            $scope.auditors.push({id: 'null'});
        }

        $scope.rmAud = function (type) {
            $scope.auditors.splice(-1, 1);
        }
        $scope.addAtt = function () {
            $scope.attachments.push({name: ''});
        }

        $scope.rmAtt = function (type) {
            $scope.attachments.splice(-1, 1);
        }

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $window.Laravel.csrfToken
            }
        });

        $scope.processClient = function () {
            $scope.processing = true;

            setTimeout(function () {
                $scope.$apply();
                $('html, body').animate({
                    scrollTop: $("#processing").offset().top
                }, 400);
            }, 100);

            $scope.errors = [];
            var data = new FormData($('#client_form')[0]);
            $.ajax({
                url: '/client/save',
                type: 'post',
                data: data,
                cache: false,
                contentType: false,
                processData: false,
                success: function (data) {
                    console.log(data);
                    $scope.processing = false;
                    $scope.success = true;
                    $scope.id = data.client_id;
                    $scope.$apply();
                    $('html, body').animate({
                        scrollTop: $("#success").offset().top
                    }, 400);

                    if ($scope.client) {
                        setTimeout(function () {
                            location.reload();
                        }, 500);
                    }

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

        $scope.delAtt = function (index) {
            if (!confirm('هل أنت متأكد من حذف الملحق؟'))
                return;
            var att = $scope.view_attachments[index];
            $.ajax({
                url: '/client/del-att/' + att.id,
                type: 'get',
                success: function (data) {
                    console.log(data);
                    $scope.view_attachments.splice(index, 1);
                    $scope.$apply();
                },
                error: function (e) {
                    console.log(e.responseText);
                    $scope.$apply();
                },
            });
        }

    }]);