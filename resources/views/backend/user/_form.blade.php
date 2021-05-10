@csrf
<div class="control-group">
    <label class="control-lable">Full name</label>
    <div class="controls">
        <input type="text" name="name" class="span8 @error('name') border-red @enderror" placeholder="name" value="{{$user->name}}">
    </div>
     @error('name')
    <span class="invalid-feedback" role="alert">
    <strong style="color:red;">{{ $message }}</strong>
    </span>
    @enderror  
</div>
<div class="control-group">
    <label class="control-lable">Email</label>
    <div class="controls">
        <input type="text" name="email" class="span8 @error('email') border-red @enderror" placeholder="email" value="{{$user->email}}">
    </div>
     @error('email')
    <span class="invalid-feedback" role="alert">
    <strong style="color:red;">{{ $message }}</strong>
    </span>
    @enderror  
</div>
<div class="control-group">
<label class="control-lable" for="password">Password</label>
<div class="controls"> 
    <input type="text" name="password" class="span8 @error('password') border-red @enderror" placeholder="password">
</div>
 @error('password')
<span class="invalid-feedback" role="alert">
    <strong style="color:red;">{{ $message }}</strong>
</span>
@enderror      
</div>
<div class="control-group">
<label class="control-lable" for="occupation">Occupation</label>
<div class="controls"> 
    <input type="text" name="occupation" class="span8 @error('question') border-red @enderror" placeholder="occupation" value="{{$user->occupation}}">
</div>
 @error('occupation')
<span class="invalid-feedback" role="alert">
    <strong style="color:red;">{{ $message }}</strong>
</span>
@enderror      
</div>
<div class="control-group">
<label class="control-lable" for="occupation">Address</label>
<div class="controls"> 
    <input type="text" name="address" class="span8 @error('address') border-red @enderror" placeholder="address" value="{{$user->address}}">
</div>
 @error('address')
<span class="invalid-feedback" role="alert">
    <strong style="color:red;">{{ $message }}</strong>
</span>
@enderror      
</div>
<div class="control-group">
<label class="control-lable" for="occupation">Phone</label>
<div class="controls"> 
    <input type="text" name="phone" class="span8 @error('phone') border-red @enderror" placeholder="phone" value="{{$user->phone}}">
</div>
 @error('phone')
<span class="invalid-feedback" role="alert">
    <strong style="color:red;">{{ $message }}</strong>
</span>
@enderror      
</div>                                
<div class="control-group">
    <button type="submit" class="btn btn-success">{{ $buttonText }}</button>
</div> 