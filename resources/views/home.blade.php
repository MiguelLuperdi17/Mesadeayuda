<!DOCTYPE html>
<html lang="en-US" dir="ltr">
@include('layouts.styles')
<body>
<main class="main" id="top">
    @include('layouts.menu')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">
                    <div class="section">
                        <div class="card">
                            <div class="card-body">
                                Sección 1<br><br><br><br><br><br><br><br><br>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="section">
                        <div class="card">
                            <div class="card-body">
                                Sección 2<br><br><br><br><br><br><br><br><br>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="section">
                        <div class="card">
                            <div class="card-body">
                                Sección 3<br><br><br><br><br><br><br><br><br>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="section">
                        <div class="card">
                            <div class="card-body">
                                Sección 4<br><br><br><br><br><br><br><br><br>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('layouts.footer')
    </div>
    @extends('layouts.chat')
</main>
@extends('layouts.setting')

@extends('layouts.scripts')
<script>
    new DataTable('#example', {
        layout: {
            topStart: {
                buttons: ['copy', 'csv', 'excel', 'pdf', 'print']
            }
        }
    });
</script>
</body>
</html>
