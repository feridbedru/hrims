 <div class="row">
          <div class="col-md-6 col-sm-6 col-12">
            <div class="info-box bg-gradient-success">
                 <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                <label for="name" class="col-md-2 control-label">Name</label>
                    <input class="form-control" name="name" type="text" id="name" value="{{ old('name', optional($roles)->name) }}" minlength="1" maxlength="255" placeholder="Enter name here...">
                    {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            </div>
            <div class="form-group {{ $errors->has('description') ? 'has-error' : '' }}">
            <div class="info-box bg-gradient-success">
            <label for="description" class="col-md-2 control-label">Description</label>
            <div class="col-md-10">
                <textarea class="form-control" name="description" cols="50" rows="10" id="description" minlength="1" maxlength="1000">{{ old('description', optional($roles)->description) }}</textarea>
                {!! $errors->first('description', '<p class="help-block">:message</p>') !!}
            </div>

              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
  </div>
 </div>
          <div {{ $errors->has('permission') ? 'has-error' : '' }}">
        <label for="permission" class="col-md-12 control-label">Permission</label>
        <div class="col-md-12">
            <select  class="select2 form-control select2-multiple "  multiple="multiple" id="permission" name="permission[]">

@foreach($permissions as $permission)

                        @if(in_array($permission->id, $selectedPermission))
                        <option value="{{$permission->id}}" selected>{{$permission->name}}</option>
                        @else
                        <option value="{{$permission->id}}">{{$permission->name}}</option>

                        @endif

                        @endforeach
            </select>
        </div>
    </div>

          <div class="col-md-6 col-sm-6 col-12">
           <div class="info-box bg-gradient-success">
           <label for="display_name" class="col-md-2 control-label">Display Name</label>
    <div>
        <input class="form-control" name="display_name" type="text" id="display_name" value="{{ old('display_name', optional($roles)->display_name) }}" minlength="1" placeholder="Enter display name here...">
        {!! $errors->first('display_name', '<p class="help-block">:message</p>') !!}
    </div>



          <!-- /.col -->
        </div>
        <!-- /.row -->


