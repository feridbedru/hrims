 <div class="row">
     <div class="col-md-6 col-sm-6 col-12">
         <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
             <label for="name" class="col-md-2 control-label">Name</label>
             <input class="form-control" name="name" type="text" id="name"
                 value="{{ old('name', optional($roles)->name) }}" minlength="1" maxlength="255"
                 placeholder="Enter name here...">
         </div>
     </div>
     <div class="col-md-6 col-sm-6 col-12">
         <label for="display_name" class="col-md-2 control-label">Display Name</label>
         <div>
             <input class="form-control" name="display_name" type="text" id="display_name"
                 value="{{ old('display_name', optional($roles)->display_name) }}" minlength="1"
                 placeholder="Enter display name here...">
         </div>
     </div>
 </div>
 <div class="col-md-12">
     <label for="description" class="col-md-12 control-label">Description</label>
     <textarea class="form-control" name="description" rows="5" id="description" minlength="1"
         maxlength="1000">{{ old('description', optional($roles)->description) }}</textarea>
 </div>
 <label for="permission" class="col-md-12 control-label">Permission</label>
 <div class="col-md-12">
     <select class="select2 form-control select2-multiple " multiple="multiple" id="permission" name="permission[]">
         @foreach ($permissions as $permission)
             @if (in_array($permission->id, $selectedPermission))
                 <option value="{{ $permission->id }}" selected>{{ $permission->name }}</option>
             @else
                 <option value="{{ $permission->id }}">{{ $permission->name }}</option>
             @endif
         @endforeach
     </select>
 </div>
