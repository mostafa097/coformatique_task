<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="au theme template">
    <meta name="author" content="Hau Nguyen">
    <meta name="keywords" content="au theme template">

    <!-- Title Page-->
    <title>Messages</title>

    <!-- Fontfaces CSS-->
    <link href="css/font-face.css" rel="stylesheet" media="all">
    <link href="vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
    <link href="vendor/font-awesome-5/css/fontawesome-all.min.css" rel="stylesheet" media="all">
    <link href="vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">

    <!-- Bootstrap CSS-->
    <link href="vendor/bootstrap-4.1/bootstrap.min.css" rel="stylesheet" media="all">

    <!-- Vendor CSS-->

    <link href="vendor/bootstrap-progressbar/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet" media="all">
    <link href="vendor/wow/animate.css" rel="stylesheet" media="all">
    <link href="vendor/css-hamburgers/hamburgers.min.css" rel="stylesheet" media="all">
    <link href="vendor/slick/slick.css" rel="stylesheet" media="all">
    <link href="vendor/select2/select2.min.css" rel="stylesheet" media="all">
    <link href="vendor/perfect-scrollbar/perfect-scrollbar.css" rel="stylesheet" media="all">

    <!-- Main CSS-->
    <link href="css/theme.css" rel="stylesheet" media="all">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

    <script type="text/javascript" src="js/datatables.min.js"></script>
</head>

<script type="text/javascript">
    var sum = 0;
    var orderid = 0;
    var rows = "";

    $(document).ready(function () {

        jQuery.ajax({
            url: "../control/user/get_includes_order.php",
            method: 'POST',


            success: function (answer) {


                var arr = answer.split("~");
                var rows = "";
                for (var row = 0; row < arr.length - 2; row += 2) {

                    rows += '<option  value="' + arr[row] + "~" + arr[row + 1] + '">' + arr[row + 1] + '</option>';

                }
                jQuery('#include-select').html(rows);


                //  jQuery('.tbl-body3').html(rowws);

                $("#includes-div").fadeIn(500);
            }



            //tableData();

        });
        showmessages();

        $(".au-btn-plus").click(function () {

            const {value: text} = Swal.fire({
                input: 'textarea',
                inputLabel: 'Message',
                inputPlaceholder: 'Type your message here...',
                inputAttributes: {
                    'aria-label': 'Type your message here'
                },
                showCancelButton: true
            })

            if (text) {
                Swal.fire(text)
                alert(text);
            }

            $(".swal2-confirm").click(function () {
                var Message = $(".swal2-textarea").val();


                jQuery.ajax({
                    url: "../control/user/add_message.php",
                    method: 'POST',
                    async: false,
                    data: {

                        msg: Message,
                        parent: 0,


                    },


                    success: function (answer) {

                        if (answer) {

                            alert("message added successfully !");


                        }

                    }


                });

            });


        });


        function showmessages() {

            jQuery.ajax({
                url: "../control/user/get_messages.php",
                method: 'POST',
                async: false,
                data: {
                    parent: '0',
                },


                success: function (answer) {
                    var arr = answer.split("~");
                    for (var row = 0; row < arr.length - 4; row += +4) {


                        if (arr[row + 2] == 0) {

                            $('<div class="au-message__item-inner"style="padding-left: 5px;">' +
                                '<div class="au-message__item-text">' +
                                '<div class="avatar-wrap">' +

                                '</div>' +
                                '<div class="text" id="message">' +
                                '<h5 class="name">' + arr[row + 3] + '</h5>' +
                                '<p>' + arr[row + 1] + '</p>' +
                                '</div>' +
                                '</div>' +
                                '<div class="au-message__item-time">' +
                                '<span><i class="fas fa-trash" value=' + arr[row] + '></i></span>' +
                                '<span><i class="fas fa-reply" value=' + arr[row] + '></i></span>' +
                                '</div>' +
                                '</div>').appendTo('#message');


                        } else {

                            $('<div class="au-message__item-inner" >' +
                                '<div class="au-message__item-text">' +
                                '<div class="avatar-wrap">' +

                                '</div>' +
                                '<div class="text" id="message" ">' +
                                '<h5 class="name">' + arr[row + 3] + '</h5>' +
                                '<p>' + arr[row + 1] + '</p>' +
                                '</div>' +
                                '</div>' +
                                '<div class="au-message__item-time">' +
                                '<span><i class="fas fa-trash" value=' + arr[row] + '></i></span>' +
                                '<span><i class="fas fa-edit" value=' + arr[row] + '></i></span>' +
                                '</div>' +
                                '</div>').appendTo('#message');
                        }


                    }
                    trashbutton();
                    editbutton();
                    replybutton();


                }


            });


        }

        function trashbutton() {
            $(".fa-trash").click(function () {

                var value = $(this).attr("value");


                jQuery.ajax({
                    url: "../control/user/delete_message.php",
                    method: 'POST',
                    data: {
                        id: value,

                    },


                    success: function (answer) {


                        location.reload();

                    }


                });


            });


        }

        function replybutton() {
            $(".fa-reply").click(function () {


                var id = $(this).attr("value");
                const {value: text} = Swal.fire({
                    input: 'textarea',
                    inputLabel: 'Message',
                    inputPlaceholder: 'Type your message here...',
                    inputAttributes: {
                        'aria-label': 'Type your message here'
                    },
                    showCancelButton: true
                })

                if (text) {
                    Swal.fire(text)
                }



                $(".swal2-confirm").click(function () {
                    var Message = $(".swal2-textarea").val();
                    jQuery.ajax({
                        url: "../control/user/add_message.php",
                        method: 'POST',
                        async: false,
                        data: {

                            msg: Message,
                            parent: id,


                        },


                        success: function (answer) {

                            if (answer) {


                                location.reload();

                            }

                        }


                    });


                });
            });


        }

        function editbutton() {
            $(".fa-edit").click(function () {

                var value = $(this).attr("value");
                const {value: text} = Swal.fire({
                    input: 'textarea',
                    inputLabel: 'Message',
                    inputPlaceholder: 'Type your message here...',
                    inputAttributes: {
                        'aria-label': 'Type your message here'
                    },
                    showCancelButton: true
                })

                if (text) {
                    Swal.fire(text)
                }
                $(".swal2-confirm").click(function () {
                    var Message = $(".swal2-textarea").val();


                    jQuery.ajax({
                        url: "../control/user/update_message.php",
                        method: 'POST',
                        async: false,
                        data: {
                            id: value,
                            msg: Message,


                        },


                        success: function (answer) {

                            if (answer) {

                                location.reload();


                            }

                        }


                    });

                });


            });


        }

    });


</script>
<body>
<div class="page-wrapper">
    <!-- HEADER MOBILE-->
    <header class="header-mobile d-block d-lg-none">
        <div class="header-mobile__bar">
            <div class="container-fluid">
                <div class="header-mobile-inner">
                    <a class="logo" href="index.html">
                        <img src="images/icon/logo.png" alt="CoolAdmin"/>
                    </a>
                    <button class="hamburger hamburger" type="button">
                            <span class="hamburger-box">
                                <span class="hamburger-inner"></span>
                            </span>
                    </button>
                </div>
            </div>
        </div>

    </header>
    <!-- END HEADER MOBILE-->

    <!-- MENU SIDEBAR-->
    <!-- END MENU SIDEBAR-->

    <!-- PAGE CONTAINER-->
    <div class="page-container">
        <!-- HEADER DESKTOP-->
        <header class="header-desktop">
            <div class="section__content section__content--p30">
                <div class="container-fluid">
                    <div class="header-wrap">

                        <div class="header-button">
                            <div class="noti-wrap">

                            </div>


                        </div>
                        <div class="account-wrap">
                            <div class="account-item clearfix js-item-menu">
                                <div class="image">

                                </div>
                                <div class="content">
                                    <a class="js-acc-btn" href="#">coformatique</a>
                                </div>
                                <div class="account-dropdown js-dropdown">


                                    <div class="account-dropdown__footer">
                                        <a href="logout.php">
                                            <i class="zmdi zmdi-power"></i>Logout</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </header>
        <!-- END HEADER DESKTOP-->

        <!-- MAIN CONTENT-->
        <div class="main-content">
            <div class="section__content section__content--p30">
                <div class="container-fluid">
                    <div class="row">

                        <div class="col-lg-6">
                            <div class="au-card au-card--no-shadow au-card--no-pad m-b-40">
                                <div class="au-card-title" style="background-image:url('images/bg-title-02.jpg');">
                                    <div class="bg-overlay bg-overlay--blue"></div>
                                    <h3>
                                        <i class="zmdi zmdi-comment-text"></i>New Messages</h3>
                                    <button class="au-btn-plus">
                                        <i class="zmdi zmdi-plus"></i>
                                    </button>
                                </div>
                                <div class="au-inbox-wrap js-inbox-wrap">
                                    <div class="au-message js-list-load">
                                        <div class="au-message__noti">

                                        </div>
                                        <div class="au-message-list">
                                            <div class="au-message__item unread" id="message">

                                            </div>


                                        </div>

                                    </div>

                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<!-- END PAGE CONTAINER-->

</div>

<!-- Jquery JS-->
<script src="vendor/jquery-3.2.1.min.js"></script>
<!-- Bootstrap JS-->
<script src="vendor/bootstrap-4.1/popper.min.js"></script>
<script src="vendor/bootstrap-4.1/bootstrap.min.js"></script>
<!-- Vendor JS       -->
<script src="vendor/slick/slick.min.js">
</script>
<script src="vendor/wow/wow.min.js"></script>
s

<script src="vendor/bootstrap-progressbar/bootstrap-progressbar.min.js">
</script>
<script src="vendor/counter-up/jquery.waypoints.min.js"></script>
<script src="vendor/counter-up/jquery.counterup.min.js">
</script>
<script src="vendor/circle-progress/circle-progress.min.js"></script>
<script src="vendor/perfect-scrollbar/perfect-scrollbar.js"></script>
<script src="vendor/chartjs/Chart.bundle.min.js"></script>
<script src="vendor/select2/select2.min.js">
</script>

<!-- Main JS-->
<script src="js/main.js"></script>

</body>

</html>
<!-- end document-->