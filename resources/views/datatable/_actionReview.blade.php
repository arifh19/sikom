@if(Auth::user()->Reviews()->where('proposal_id', $proposal_id)->where('user_id',Auth::user()->id)->where('is_review', 1)->count() > 0)
Sudah anda Review
@else
Belum anda Review
@endif