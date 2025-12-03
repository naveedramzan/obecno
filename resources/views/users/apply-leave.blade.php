@extends('company-admin')
@section('content')
   
  <div class="wrapper d-flex flex-column min-vh-100 bg-light">
    <div class="body-content">
        <div class="overview-content-wrapper">
            <div class="dashboard-section">
                <div class="dashboard-content">
                    <div class="leave-application-section" style="width: 100%;">
                        <div class="leave-card" style="background: #fff; border-radius: 12px; padding: 2rem; box-shadow: 0 2px 8px rgba(0,0,0,0.1);">
                            <h2 style="margin-bottom: 1.5rem; color: #333;">Apply for Leave</h2>
                            
                            @if(session('success'))
                                <div class="alert alert-success" style="padding: 12px; margin-bottom: 1.5rem; background: #d4edda; color: #155724; border: 1px solid #c3e6cb; border-radius: 6px;">
                                    {{ session('success') }}
                                </div>
                            @endif
                            
                            @if(session('error'))
                                <div class="alert alert-danger" style="padding: 12px; margin-bottom: 1.5rem; background: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; border-radius: 6px;">
                                    {{ session('error') }}
                                </div>
                            @endif
                            
                            @if($errors->any())
                                <div class="alert alert-danger" style="padding: 12px; margin-bottom: 1.5rem; background: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; border-radius: 6px;">
                                    <ul style="margin: 0; padding-left: 20px;">
                                        @foreach($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            
                            <form id="leaveForm" method="POST" action="{{ route('leave.store') }}">
                                @csrf
                                
                                <div class="form-row" style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem; margin-bottom: 1.5rem;">
                                    <div class="form-group">
                                        <label for="start_date" style="display: block; margin-bottom: 0.5rem; color: #333; font-weight: 600;">Start Date</label>
                                        <input type="date" name="start_date" id="start_date" class="form-control" style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 6px;" value="{{ old('start_date') }}" required>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="end_date" style="display: block; margin-bottom: 0.5rem; color: #333; font-weight: 600;">End Date</label>
                                        <input type="date" name="end_date" id="end_date" class="form-control" style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 6px;" value="{{ old('end_date') }}" required>
                                    </div>
                                </div>
                                
                                <div class="form-row" style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem; margin-bottom: 1.5rem;">
                                    <div class="form-group">
                                        <label for="leavetype_id" style="display: block; margin-bottom: 0.5rem; color: #333; font-weight: 600;">Leave Type</label>
                                        <select name="leavetype_id" id="leavetype_id" class="form-control" style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 6px;" required>
                                            <option value="">Select Leave Type</option>
                                            @foreach($leaveTypes as $leaveType)
                                                <option value="{{ $leaveType->id }}" {{ old('leavetype_id') == $leaveType->id ? 'selected' : '' }}>
                                                    {{ $leaveType->title }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="total_days" style="display: block; margin-bottom: 0.5rem; color: #333; font-weight: 600;">Number of Days</label>
                                        <input type="text" id="total_days" class="form-control" style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 6px; background-color: #f8f9fa; cursor: not-allowed;" readonly value="0">
                                    </div>
                                </div>
                                
                                <div class="form-actions" style="display: flex; gap: 1rem; justify-content: flex-end;">
                                    <button type="button" onclick="window.location='{{ route('dashboard') }}'" class="btn btn-secondary" style="padding: 10px 24px; border-radius: 6px; border: 1px solid #ddd; background: #f8f9fa; color: #333; cursor: pointer;">
                                        Cancel
                                    </button>
                                    <button type="submit" class="btn btn-primary" style="padding: 10px 24px; border-radius: 6px; border: none; background: #007bff; color: white; cursor: pointer;">
                                        Submit Leave Request
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const startDateInput = document.getElementById('start_date');
    const endDateInput = document.getElementById('end_date');
    const totalDaysInput = document.getElementById('total_days');
    
    // Holidays array from server
    const holidays = @json($holidays);
    
    // Set minimum date to today
    const today = new Date().toISOString().split('T')[0];
    startDateInput.setAttribute('min', today);
    endDateInput.setAttribute('min', today);
    
    // Function to check if a date is a weekend (Saturday=6, Sunday=0)
    function isWeekend(date) {
        const day = date.getDay();
        return day === 0 || day === 6; // Sunday or Saturday
    }
    
    // Function to check if a date is a holiday
    function isHoliday(date) {
        const dateStr = date.toISOString().split('T')[0];
        return holidays.includes(dateStr);
    }
    
    // Function to check if a date should be excluded (weekend or holiday)
    function shouldExcludeDate(date) {
        return isWeekend(date) || isHoliday(date);
    }
    
    // Function to calculate number of days excluding weekends and holidays
    function calculateDays() {
        const startDate = startDateInput.value;
        const endDate = endDateInput.value;
        
        if (startDate && endDate) {
            const start = new Date(startDate + 'T00:00:00');
            const end = new Date(endDate + 'T00:00:00');
            
            if (end >= start) {
                let workingDays = 0;
                const currentDate = new Date(start);
                
                // Loop through each day from start to end (inclusive)
                while (currentDate <= end) {
                    if (!shouldExcludeDate(currentDate)) {
                        workingDays++;
                    }
                    // Move to next day
                    currentDate.setDate(currentDate.getDate() + 1);
                }
                
                totalDaysInput.value = workingDays;
            } else {
                totalDaysInput.value = '0';
            }
        } else {
            totalDaysInput.value = '0';
        }
    }
    
    // Update end date minimum when start date changes
    startDateInput.addEventListener('change', function() {
        endDateInput.setAttribute('min', this.value);
        if (endDateInput.value && endDateInput.value < this.value) {
            endDateInput.value = this.value;
        }
        calculateDays();
    });
    
    // Calculate days when end date changes
    endDateInput.addEventListener('change', function() {
        calculateDays();
    });
    
    // Calculate days on page load if dates are pre-filled
    calculateDays();
});
</script>

@endsection

