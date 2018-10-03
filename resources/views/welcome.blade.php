@extends('layouts.layout')

@section('content')
    <div>
        
        <h1>Test</h1>

        <form method="POST" action="/create-campaign" enctype="multipart/form-data">
            {{ csrf_field() }}

            <div class="form-group">
                <label for="campaign_name">Campaign Name:</label>
                <input  type="text" 
                        class="form-control" 
                        name="campaign_name" 
                        required>
            </div>

            <div class="form-group">
                <label for="placement_name">Placement Name:</label>
                <input  type="text" 
                        class="form-control" 
                        name="placement_name" 
                        required>
            </div>

            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="" id="300x250">
                <label class="form-check-label" for="300x250">
                    300x250
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="" id="300x600">
                <label class="form-check-label" for="300x600">
                    300x600                
                </label>
            </div>

            <div class="form-group">
                <label for="image">Image:</label>
                <input  type="file" 
                        class="form-control" 
                        name="image" 
                        id="image">
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary">
                    Submit
                </button>
            </div>
            
        </form>

    </div>
@endsection