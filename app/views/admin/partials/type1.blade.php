<div class="col-xs-12 col-md-6 formulario">
   <div class="input-group">
      <label class="item-label">Talla (español)</label>
      <label class="control-label label-control-success hidden"><i class="fa fa-check"></i> <p class="success-text"></p></label>
      <label class="control-label label-control-danger hidden"><i class="fa fa-times-circle"></i> <p class="danger-text"></p></label>
      <input type="text" class="form-control" name="size_es[]" placeholder="Talla (español)" value="{{ Input::old('size_es.0') }}" required>
      @if($errors->has('size_es'))
         @foreach($errors->get('size_es') as $err)
         <div class="clearfix"></div>
         <div class="alert alert-danger">
           <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
           {{ $err }}
         </div>
         @endforeach
       @endif
   </div>
</div>
<div class="col-xs-12 col-md-6 formulario">
   <div class="input-group">
      <label class="item-label">Talla (ingles)</label>
      <label class="control-label label-control-success hidden"><i class="fa fa-check"></i> <p class="success-text"></p></label>
      <label class="control-label label-control-danger hidden"><i class="fa fa-times-circle"></i> <p class="danger-text"></p></label>
      <input type="text" class="form-control" name="size_eng[]" placeholder="Talla (ingles)" value="{{ Input::old('size_eng.0') }}" required>
      @if($errors->has('size_eng'))
         @foreach($errors->get('size_eng') as $err)
         <div class="clearfix"></div>
         <div class="alert alert-danger">
           <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
           {{ $err }}
         </div>
         @endforeach
       @endif
   </div>
</div>
@if(count(Input::old('size_es')) > 2)
   @for($i = 1; $i < count(Input::old('size_es')); $i++)
      @if(!empty(Input::old('size_es')[$i]))
      <div class="col-xs-12 no-padding to-clone active">
         <button type="button" class="close dimiss-cloned">&times;</button>
         <div class="col-xs-12 col-md-6 formulario">
            <input type="text" class="form-control" name="size_es[{{$i}}]" placeholder="Talla (español)" value="{{ Input::old('size_es.'.$i) }}" required>
         </div>
         <div class="col-xs-12 col-md-6 formulario">
            <input type="text" class="form-control" name="size_eng[{{$i}}]" placeholder="Talla (ingles)" value="{{ Input::old('size_eng.'.$i) }}" required>
         </div>
      </div>
      @endif
   @endfor
   <div class="col-xs-12 no-padding new-size to-clone">
      <button type="button" class="close dimiss-cloned">&times;</button>
      <div class="col-xs-12 col-md-6 formulario">
         <input type="text" class="form-control" name="" placeholder="Talla (español)" value="" required>
      </div>
      <div class="col-xs-12 col-md-6 formulario">
         <input type="text" class="form-control" name="" placeholder="Talla (ingles)" value="" required>
      </div>
   </div>

@else
   <div class="col-xs-12 no-padding new-size to-clone">
      <button type="button" class="close dimiss-cloned">&times;</button>
      <div class="col-xs-12 col-md-6 formulario">
         <input type="text" class="form-control size_es" name="" placeholder="Talla (español)" value="{{ Input::old('size_es.1') }}" required>
      </div>
      <div class="col-xs-12 col-md-6 formulario">
         <input type="text" class="form-control size_eng" name="" placeholder="Talla (ingles)" value="{{ Input::old('size_eng.1') }}" required>
      </div>
   </div>
@endif
<div class="col-xs-12 formulario">
   <button type="button" class="btn btn-primary btn-clone" data-target="new-size" data-input="size_" data-name-es="size_es[]" data-name-eng="size_eng[]">
     Agregar Talla
   </button>
</div>
<div class="col-xs-12 col-md-6 formulario">
   <div class="input-group">
      <label class="item-label">Colores (español)</label>
      <label class="control-label label-control-success hidden"><i class="fa fa-check"></i> <p class="success-text"></p></label>
      <label class="control-label label-control-danger hidden"><i class="fa fa-times-circle"></i> <p class="danger-text"></p></label>
      <input type="text" class="form-control" name="color_es[]" placeholder="Color (español)" value="{{ Input::old('color_es.0')}}" required>
      @if($errors->has('color_es'))
         @foreach($errors->get('color_es') as $err)
         <div class="clearfix"></div>
         <div class="alert alert-danger">
           <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
           {{ $err }}
         </div>
         @endforeach
      @endif
   </div>
</div>
<div class="col-xs-12 col-md-6 formulario">
   <div class="input-group">
      <label class="item-label">Colores (ingles)</label>
      <label class="control-label label-control-success hidden"><i class="fa fa-check"></i> <p class="success-text"></p></label>
      <label class="control-label label-control-danger hidden"><i class="fa fa-times-circle"></i> <p class="danger-text"></p></label>
      <input type="text" class="form-control" name="color_eng[]" placeholder="Color (ingles)" value="{{ Input::old('color_eng.0') }}" required>
      @if($errors->has('color_eng'))
         @foreach($errors->get('color_eng') as $err)
         <div class="clearfix"></div>
         <div class="alert alert-danger">
           <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
           {{ $err }}
         </div>
         @endforeach
      @endif
   </div>
</div>
@if(count(Input::old('color_es')) > 2)
   @for($i = 1; $i < count(Input::old('color_es')); $i++)
      @if(!empty(Input::old('')[$i]))
      <div class="col-xs-12 no-padding to-clone active">
         <button type="button" class="close dimiss-cloned">&times;</button>
         <div class="col-xs-12 col-md-6 formulario">
            <input type="text" class="form-control" name="color_es[{{$i}}]" placeholder="Color (español)" value="{{ Input::old('color_es.'.$i) }}" required>
         </div>
         <div class="col-xs-12 col-md-6 formulario">
            <input type="text" class="form-control" name="color_eng[{{$i}}]" placeholder="Color (ingles)" value="{{ Input::old('color_eng.'.$i) }}" required>
         </div>
      </div>
      @endif
   @endfor
   <div class="col-xs-12 no-padding new-color to-clone">
      <button type="button" class="close dimiss-cloned">&times;</button>
      <div class="col-xs-12 col-md-6 formulario">
         <input type="text" class="form-control color_es" placeholder="Color (español)" value="" required>
      </div>
      <div class="col-xs-12 col-md-6 formulario">
         <input type="text" class="form-control color_eng" placeholder="Color (ingles)" value="" required>
      </div>
   </div>
@else
   <div class="col-xs-12 no-padding new-color to-clone">
      <button type="button" class="close dimiss-cloned">&times;</button>
      <div class="col-xs-12 col-md-6 formulario">
         <input type="text" class="form-control color_es" placeholder="Color (español)" value="{{ Input::old('color_es.1') }}" required>
      </div>
      <div class="col-xs-12 col-md-6 formulario">
         <input type="text" class="form-control color_eng" placeholder="Color (ingles)" value="{{ Input::old('color_eng.1') }}" required>
      </div>
   </div>
@endif
<div class="col-xs-12 formulario">
   <button type="button" class="btn btn-primary btn-clone" data-target="new-color" data-input="color_" data-name-es="color_es[]" data-name-eng="color_eng[]">
     Agregar Color
   </button>
</div>
<div class="col-xs-12 col-md-6 formulario">
   <div class="input-group">
      <label class="item-label">Material (español)</label>
      <label class="control-label label-control-success hidden"><i class="fa fa-check"></i> <p class="success-text"></p></label>
      <label class="control-label label-control-danger hidden"><i class="fa fa-times-circle"></i> <p class="danger-text"></p></label>
      <input type="text" class="form-control" name="fabric_es[]" placeholder="Material (español)" value="{{ Input::old('fabric_es.0') }}" required>
      @if($errors->has('fabric_es'))
         @foreach($errors->get('fabric_es') as $err)
         <div class="clearfix"></div>
         <div class="alert alert-danger">
           <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
           {{ $err }}
         </div>
         @endforeach
      @endif
   </div>
</div>
<div class="col-xs-12 col-md-6 formulario">
   <div class="input-group">
      <label class="item-label">Material (ingles)</label>
      <label class="control-label label-control-success hidden"><i class="fa fa-check"></i> <p class="success-text"></p></label>
      <label class="control-label label-control-danger hidden"><i class="fa fa-times-circle"></i> <p class="danger-text"></p></label>
      <input type="text" class="form-control" name="fabric_eng[]" placeholder="Material (ingles)" value="{{ Input::old('fabric_eng.0') }}" required>
      @if($errors->has('fabric_eng'))
         @foreach($errors->get('fabric_eng') as $err)
         <div class="clearfix"></div>
         <div class="alert alert-danger">
           <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
           {{ $err }}
         </div>
         @endforeach
      @endif
   </div>
</div>
@if(count(Input::old('fabric_es')) > 2)
   @for($i = 1; $i < count(Input::old('fabric_es')); $i++)
      @if(!empty(Input::old('')[$i]))
      <div class="col-xs-12 no-padding to-clone active">
         <button type="button" class="close dimiss-cloned">&times;</button>
         <div class="col-xs-12 col-md-6 formulario">
            <input type="text" class="form-control" name="fabric_es[{{$i}}]" placeholder="Material (español)" value="{{ Input::old('fabric_es.'.$i) }}" required>
         </div>
         <div class="col-xs-12 col-md-6 formulario">
            <input type="text" class="form-control" name="fabric_eng[{{$i}}]" placeholder="Material (ingles)" value="{{ Input::old('fabric_eng.'.$i) }}" required>
         </div>
      </div>
      @endif
   @endfor
   <div class="col-xs-12 no-padding new-fabric to-clone">
      <button type="button" class="close dimiss-cloned">&times;</button>
      <div class="col-xs-12 col-md-6 formulario">
         <input type="text" class="form-control fabric_es" placeholder="Material (español)" value="" required>
      </div>
      <div class="col-xs-12 col-md-6 formulario">
         <input type="text" class="form-control fabric_eng" placeholder="Material (ingles)" value="" required>
      </div>
   </div>
@else
   <div class="col-xs-12 no-padding new-fabric to-clone">
      <button type="button" class="close dimiss-cloned">&times;</button>
      <div class="col-xs-12 col-md-6 formulario">
         <input type="text" class="form-control fabric_es" placeholder="Material (español)" value="" required>
      </div>
      <div class="col-xs-12 col-md-6 formulario">
         <input type="text" class="form-control fabric_eng" placeholder="Material (ingles)" value="" required>
      </div>
   </div>
@endif
<div class="col-xs-12 formulario">
   <button type="button" class="btn btn-primary btn-clone" data-target="new-fabric" data-input="fabric_" data-name-es="fabric_es[]" data-name-eng="fabric_eng[]">
     Agregar Material
   </button>                     
</div>