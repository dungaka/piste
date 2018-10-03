<form method="POST" action="/reports/ad-server">
    
    {{ csrf_field() }}
    @if (isset($report_id))
        <!-- Print the name of the report -->
    @else
        <div class="form-group">
            <label for="report_name">Report Name:</label>
            <input type="text" class="form-control" name="report_name" required>
        </div>
    @endif

    <div class="form-group">
            <label for="file_name">File Name:</label>
            <input type="text" class="form-control" name="file_name" required>
        </div>

    <div class="form-group">
        <label for="start">Start Date (yyyy-MM-dd):</label>
        <input type="text" class="form-control" name="start" required>
    </div>

    <div class="form-group">
        <label for="end">End Date (yyyy-MM-dd):</label>
        <input type="text" class="form-control" name="end" required>
    </div>

    <div class="form-group">
        <label for="client_id">Client ID:</label>
        <input type="text" class="form-control" name="client_id" required>
    </div>

    <div class="form-group">
        <label for="dimensions">Dimensions:</label>
        <input list="dimensions" name="dimensions">
        <datalist id="dimensions">
            @foreach($fields['dimensions'] as $dimension)
                <option value="{{ $dimension->name }}">
            @endforeach
        </datalist>
    </div>

    <div class="form-group">
        <label for="metrics">Metrics:</label>
        <input list="metrics" name="metrics">
        <datalist id="metrics">
            @foreach($fields['metrics'] as $metric)
                <option value="{{ $metric->name }}">
            @endforeach
        </datalist>
    </div>

    <div class="form-group">
        <button type="submit" class="btn btn-primary">Create Report</button>
    </div>

    @include('layouts.errors')

</form>