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
    <label for="insertion_order_id">Insertion Order ID:</label>
    <input  type="number"
            step="1"
            pattern="\d+"
            class="form-control" 
            name="campaign_id" 
            value="{{ old('insertion_order_id', $line_item->insertion_order_id) }}">
</div>

<div class="form-group">
    <button type="submit" class="btn btn-primary">
        {{ $submitButtonText ?? 'Create Line Item' }}
    </button>
</div>

@include('layouts.errors')