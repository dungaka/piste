{{ csrf_field() }}

<div class="form-group">
    <label for="name">Name:</label>
    <input  type="text" 
            class="form-control" 
            name="name" 
            value="{{ old('name', $campaign->name) }}"
            required>
</div>

<div class="form-group">
    <label for="client_id">Client ID:</label>
    <input  type="number"
            step="1" 
            pattern="\d+"
            class="form-control" 
            name="client_id" 
            value="{{ old('client_id', $campaign->client_id) }}">
</div>

<div class="form-group">
    <label for="dbm_id">DBM Campaign ID:</label>
    <input  type="number"
            step="1" 
            pattern="\d+"
            class="form-control" 
            name="dbm_id" 
            value="{{ old('dbm_id', $campaign->dbm_id) }}">
</div>

<div class="form-group">
    <label for="brightroll_id">Brightroll Campaign ID:</label>
    <input  type="number"
            step="1" 
            pattern="\d+"
            class="form-control" 
            name="brightroll_id" 
            value="{{ old('brightroll_id', $campaign->brightroll_id) }}">
</div>

<div class="form-group">
    <label for="dcm_id">DCM Campaign ID:</label>
    <input  type="number"
            step="1" 
            pattern="\d+"
            class="form-control" 
            name="dcm_id" 
            value="{{ old('dcm_id', $campaign->dcm_id) }}">
</div>

<div class="form-group">
    <label for="description">Description:</label>
    <textarea   class="form-control" 
                name="description" 
                value="{{ old('name', $campaign->description) }}">
    </textarea>
</div>

<div class="form-group">
    <button type="submit" class="btn btn-primary">
        {{ $submitButtonText ?? 'Create Campaign' }}
    </button>
</div>

@include('layouts.errors')