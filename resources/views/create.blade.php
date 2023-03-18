<form action="{{route('login.store')}}">
  @csrf
  <label for="">nom</label>
  <input type="text" name="first_name" class="@error('nom') is-invalide @enderror">
  @error('nom')
  <div class="alert alert-danger">{{$message}}</div>
  @enderror
  <label for="">prenom</label>
  <input type="text"  name="last_name" class="@error('prenom') is-invalide @enderror">
  @error('prenom')
  <div class="alert alert-danger">{{$message}}</div>
  @enderror
  <label for="">email</label>
  <input type="Email"  name="email" class="@error('email') is-invalide @enderror">
  @error('email')
  <div class="alert alert-danger">{{$message}}</div>
  @enderror
  <button  type="submit">sub</button>

</form>