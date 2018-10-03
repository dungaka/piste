{{ csrf_field() }}

<div class="form-group">
    <label for="name">Name:</label>
    <input  type="text" 
            class="form-control" 
            name="name" 
            value="{{ old('name', $insertion_order->name) }}"
            required>
</div>

<div class="form-group">
    <label for="client_id">Campaign ID:</label>
    <input  type="number"
            step="1" 
            pattern="\d+"
            class="form-control" 
            name="campaign_id" 
            value="{{ old('client_id', $insertion_order->campaign_id) }}">
</div>

<div class="form-group">
    <label for="dbm_id">DBM Insertion Order ID:</label>
    <input  type="number"
            step="1" 
            pattern="\d+"
            class="form-control" 
            name="dbm_id" 
            value="{{ old('dbm_id', $insertion_order->dbm_id) }}">
</div>

<div class="form-group">
    <label for="brightroll_id">Brightroll Insertion Order ID:</label>
    <input  type="number"
            step="1" 
            pattern="\d+"
            class="form-control" 
            name="brightroll_id" 
            value="{{ old('brightroll_id', $insertion_order->brightroll_id) }}">
</div>

<div class="form-group">
    <label for="dcm_id">DCM Insertion Order ID:</label>
    <input  type="number"
            step="1" 
            pattern="\d+"
            class="form-control" 
            name="dcm_id" 
            value="{{ old('dcm_id', $insertion_order->dcm_id) }}">
</div>

<div class="form-group">
    <label for="description">Description:</label>
    <textarea   class="form-control" 
                name="description" 
                value="{{ old('name', $insertion_order->description) }}">
    </textarea>
</div>

<div class="form-group">
    <button type="submit" class="btn btn-primary">
        {{ $submitButtonText ?? 'Create Insertion Order' }}
    </button>
</div>

@include('layouts.errors')