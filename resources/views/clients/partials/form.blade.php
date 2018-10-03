{{ csrf_field() }}

<div class="form-group">
    <label for="name">Name:</label>
    <input  type="text" 
            class="form-control" 
            name="name" 
            value="{{ old('name', $client->name) }}"
            required>
</div>

<div class="form-group">
    <label for="dbm_id">DBM Client ID:</label>
    <input  type="number"
            step="1" 
            pattern="\d+"
            class="form-control" 
            name="dbm_id" 
            value="{{ old('dbm_id', $client->dbm_id) }}"
            required>
</div>

<div class="form-group">
    <label for="brightroll_id">Brightroll Client ID:</label>
    <input  type="number"
            step="1" 
            pattern="\d+"
            class="form-control" 
            name="brightroll_id" 
            value="{{ old('brightroll_id', $client->brightroll_id) }}">
</div>

<div class="form-group">
    <label for="ad_server_id">DCM ID:</label>
    <input  type="number"
            step="1" 
            pattern="\d+"
            class="form-control" 
            name="ad_server_id" 
            value="{{ old('ad_server_id', $client->ad_server_id) }}">
</div>

<div class="form-group">
    <button type="submit" class="btn btn-primary">
        {{ $submitButtonText ?? 'Create Client' }}
    </button>
</div>

@include('layouts.errors')