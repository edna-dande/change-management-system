
<x-app-layout>
{{--    <x-slot name="header">--}}
{{--        <h2 class="font-semibold text-xl text-gray-800 leading-tight">--}}
{{--            {{ __('Dashboard') }}--}}
{{--        </h2>--}}
{{--    </x-slot>--}}

{{--    <div class="py-12">--}}
{{--        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">--}}
{{--            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">--}}
{{--                <div class="p-6 text-gray-900">--}}
{{--                    {{ __("You're logged in!") }}--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
    <div id="wrapper">
        <div class="overlay"></div>

        <!-- Sidebar -->
{{--        <nav class="navbar navbar-inverse fixed-top" id="sidebar-wrapper" role="navigation">--}}
{{--            <ul class="nav sidebar-nav">--}}
{{--                <div class="sidebar-header">--}}
{{--                    <div class="sidebar-brand">--}}

{{--                <ul>--}}

{{--                <li><a href="#home">Users</a></li>--}}
{{--                <li><a href="#about">Systems</a></li>--}}
{{--                <li><a href="#events">Roles</a></li>--}}
{{--                </ul>--}}
{{--                    </div>--}}
{{--                </div>--}}

{{--            </ul>--}}
{{--        </nav>--}}
{{--        <!-- /#sidebar-wrapper -->--}}

{{--        <!-- Page Content -->--}}
{{--        <div id="page-content-wrapper">--}}
{{--            <button type="button" class="hamburger animated fadeInLeft is-closed" data-toggle="offcanvas">--}}
{{--                <span class="hamb-top"></span>--}}
{{--                <span class="hamb-middle"></span>--}}
{{--                <span class="hamb-bottom"></span>--}}
{{--            </button>--}}
{{--            <div class="container">--}}
{{--                <div class="row">--}}
{{--                    <div class="col-lg-8 col-lg-offset-2">--}}
{{--                        <h1>List of users</h1>--}}
{{--                        <button class="btn btn-primary" style="background-color: #026B5B;">Create</button>--}}

{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <!-- /#page-content-wrapper -->--}}

{{--    </div>--}}
{{--    <!-- /#wrapper -->--}}
        <!DOCTYPE html>
        <html>
        <head>
            <title>Dashboard</title>
            <style>
                body {
                    margin: 0;
                    padding: 0;
                }

                .sidebar {
                    background-color: #026B5B;
                    width: 200px;
                    height: 100vh;
                    position:fixed;
                    top: 65px;
                    left: 0;
                    display: flex;
                    flex-direction: column;
                    align-items: center;
                    padding-top: 20px;
                    color: #fff;
                }

                .sidebar img {
                    width: 25px;
                    height: 25px;
                }

                .content {
                    margin-left: 220px; /* To leave space for the sidebar */
                    padding: 20px;
                    background-color: #f9fafc;
                }

                table {
                    width: 100%;
                    border-collapse: collapse;
                    margin-top: 20px;
                }

                th, td {
                    padding: 10px;
                    text-align: left;
                    border-bottom: 1px solid #ddd;
                }
            </style>
        </head>
        <body>
        <div class="sidebar">
            <!-- Replace these image paths with your own button images -->
            <button><img src="images/user_white.png" alt="users-white"><p>Users</p></button>
            <button ><img src="images/users_green.png" alt="users-green"><p>Users</p></button>

            <button><img src="images/system_white.png" alt="system-white"><p>Systems</p></button>
            <button><img src="images/system_green.png" alt="system-green"><p>Systems</p></button>

            <button><img src="images/role_white.png" alt="role-white"><p>Roles</p></button>
            <button><img src="images/role_green.png" alt="role-green"><p>Roles</p></button>

        </div>

        <div class="content">
            <h1 style="font-size: 24px; font-weight: bold">List of Users</h1>
            <p>Manage your users with ease</p>
            <button type="button" class="btn btn-primary">Create</button>

            <table style="border-radius: 20px;">
                <thead style="background-color: #026B5B; color: white;">
                <tr >
                    <th >Name</th>
                    <th>Role</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>Data 1</td>
                    <td>Data 2</td>
                    <td>Data 3</td>
                </tr>
                </tbody>
            </table>
        </div>

        </body>
        </html>
    </div>
</x-app-layout>
