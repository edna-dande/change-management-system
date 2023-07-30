<x-email-layout>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h2>User Login Credentials</h2>
                    </div>
                    <div class="card-body">
                        <p>Hello,</p>
                        <p>Your account has been created. Please use the following credentials to log in:</p>
                        <p><strong>Email:</strong> {{ $userEmail }}</p>
                        <p><strong>Password:</strong> {{ $password }}</p>
                        <p>Thank you for using our services.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-email-layout>

