@extends('layouts.app')

@section('content')

    <div class="container">

        <div class="row page-titles">
            <div class="col-md-12 align-self-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                    <li class="breadcrumb-item active">Statistiques / Notifications</li>
                </ol>
            </div>
        </div>

        <div class="row justify-content-start mt-3">
            <div class="col-lg-6">

                <form method="post" action="{{ url('getinfosnotifsparts') }}">

                    {{ csrf_field() }}

                    <div class="card card-body card-info">
                        <div class="card-title">
                            <h2 class="text-dark">L'envoi des notifications de partenaires</h2>
                        </div>

                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif

                        <div class="form-group{{ $errors->has('titre') ? ' has-error' : '' }}">
                            <label class="text-white" for="InputTitle">Titre</label>
                            <input type="text" class="form-control" id="InputTitle" name="titre" placeholder="Entrez le Titre de notification" value="{{ old('titre') }}" required>
                        </div>

                        @if($errors->first('titre')!=null)<small class="alert alert-danger ">{{ $errors->first('titre') }}</small> @endif

                        <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                            <label class="text-white" for="InputBody">Description</label>
                            <textarea class="form-control" name="description" id="InputBody" placeholder="Description" value="{{ old('description') }}" required></textarea>
                        </div>

                        @if($errors->first('description')!=null)<small class="alert alert-danger ">{{ $errors->first('description') }}</small> @endif

                        <div class="form-group{{ $errors->has('imgurl') ? ' has-error' : '' }}">
                            <label class="text-white" for="InputImage">Image</label>
                            <input type="url" class="form-control" name="imgurl" id="InputImage" value="{{ old('imgurl') }}" placeholder="Lien de Image" required>
                        </div>

                        @if($errors->first('imgurl')!=null)<small class="alert alert-danger ">{{ $errors->first('imgurl') }}</small> @endif

                        <button type="submit" class="btn btn-success">Envoyez</button>
                    </div>
                </form>
            </div>

            <div class="col-lg-6">
                <div class="smartphone">
                    <div class="content">
                       <div class="card ">
                           <div class="card-header alert-secondary ">
                                <small id="title">titre de notification</small>
                           </div>
                           <div class="card-body bg-light">
                               <strong id="body">description de notification </strong>
                               <div class="float-right" >
                                   <img id="imagenotif" width="70px" height="70px" >
                               </div>
                           </div>
                       </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <script type="text/javascript">
        $('#InputTitle').keyup(function() {
            $('#title').text($(this).val());
        });
        $('#InputBody').keyup(function() {
            $('#body').text($(this).val());
        });
        $('#InputImage').keyup(function() {
               $('#imagenotif').prop('src',$('#InputImage').val());
            $('#imagenotif').load();
        });
    </script>
@endsection
