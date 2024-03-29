@extends('dashboard')

@section('menu-content')
<div class="container">
    <button id ="new-demand" class="btn btn-primary" type="button" data-toggle="modal" data-target="#infos" class="btn btn-primary mt-3 mb-3">Nouvelle demande</button>
    <div class="modal fade" id="infos">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header"> 
                    <h4 class="modal-title">Ajouter une nouvelle demande</h4>
                </div>
                
                <div class="modal-body">
                @if(count($errors) > 0)
                    <div class="alert alert-danger">
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form class="col" action="demands" method="post">
                    @csrf
                        <div class="input-group">
                            <label for="buildingRef" class="form-control-label">Référence immeuble :</label>
                            <span class="input-group-btn" style="width:15px;"></span>
                            <div class="col">
                            
                                <select class="form-control form-control-sm mb-4" name ="buildingRef">
                                    @foreach($clients->buildings as $building) 
                                        <option value="{{ $building->id }}">{{ $building->buildingRef }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <span class="input-group-btn" style="width:15px;"></span>
                            <label for="adress_building" class="form-control-label">Adresse immeuble :</label>
                            <span class="input-group-btn" style="width:15px;"></span>
                            <div class="col">
                                <select type="text" class="form-control form-control-sm mb-4" name="adress_building">
                                    @foreach($clients->buildings as $building) 
                                        <option value="{{ $building->adress }}">{{ $building->adress }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="type_demand">Type de demande</label>
                            <!-- DEMAND TYPES : CHOICES -->
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="type_choice" value="Intervention" onclick="show1();" checked="checked">
                                    <label class="form-check-label">Intervention</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="type_choice" value="Devis" onclick="show2();">
                                    <label class="form-check-label">Devis</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="type_choice" value="Email" onclick="show3();">
                                    <label class="form-check-label">Email</label>
                                </div>
                        </div>
                    
                        <!-- Intervention form-->
                            <div class="intervention-form" id="inter">
                                <div class="input-group">
                                    <label for="desiredDate" class="form-control-label">Date souhaitée :</label>
                                    <span class="input-group-btn" style="width:15px;"></span>
                                    <div class="col-xs-3"><input type="date" class="form-control form-control-sm mb-4" name ="desiredDate"></div>
                                    <span class="input-group-btn" style="width:50px;"></span>
                                    <label for="desiredTime" class="form-control-label">Heure souhaitée :</label>
                                    <span class="input-group-btn" style="width:15px;"></span>
                                    <div class="col-xs-3"><input type="time" class="form-control form-control-sm mb-4" name="desiredTime"></div>
                                </div>
                                
                            </div>
                                <!-- Quote form-->
                                <div class="quote-form" id="quote">
                                    <div class="input-group">
                                        <label for="title_quote" class="form-control-label">Titre du devis :</label>
                                        <span class="input-group-btn" style="width:15px;"></span>
                                        <div class="col-xs-3"><input type="text" class="form-control form-control-sm mb-4" name="title_quote"></div>
                                    </div>
                                </div>
                                <!-- Email form-->
                                <div class="email-form" id="email">
                                
                                        <div class="input-group">
                                            <label for="clientEmail">Tapez votre email :</label>
                                            <span class="input-group-btn" style="width:15px;"></span>
                                            <div class="col-xs-4"><input type="email" class="form-control form-control-sm mb-4" name ="clientEmail"></div>
                                        </div>
                                </div>
                                <!-- DEMAND CONTENT -->
                                <div class="form-group">
                                    <label for="content_demand">Contenu de votre demande :</label>
                                    <textarea class="form-control" rows="5" id="content_demand" name="content"></textarea>
                                </div> 
                                <!-- CAPTCHA -->
                                <button id="close-modal" type="button" data-dismiss="modal" class="btn btn-dark mr-auto closemodal">Annuler</button>
                                <button id="submit-modal" type="submit" class="btn btn-primary">Valider</button>
                </div>
                <div class="modal-footer">
                    
                    
                </div>
                </form>
            </div>
        </div>
    </div>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Date</th>
                <th>Type de demande</th>
                <th>Contenu</th>
                <th>Action</th>    
            </tr>
        </thead>
        <tbody>
            @foreach($demands as $demand)
            <tr>
                <td>{{ $demand->date_demand }}</td>
                <td>{{ $demand->type_demand }}</td>
                <td>{{ substr($demand->content_demand,0,40) }}...</td>
                <td class="cell-center"> <a href="{{ URL::to('demands/' . $demand->id) }}"> <i class="fas fa-eye"></i> </a> </td>   
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection
<!-- JS -->
<script type="text/javascript">
		function show1(){
  			document.getElementById('inter').style.display ='block';
  			document.getElementById('quote').style.display = 'none';
            document.getElementById('email').style.display = 'none';
		}
		function show2(){
            document.getElementById('inter').style.display ='none';
  			document.getElementById('quote').style.display = 'block';
            document.getElementById('email').style.display = 'none';
		}
        function show3(){
            document.getElementById('inter').style.display ='none';
  			document.getElementById('quote').style.display = 'none';
            document.getElementById('email').style.display = 'block';
		}
	</script>

    