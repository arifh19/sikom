@extends('layouts.app')

@section('dashboard')
   Team
   <small>Team Info</small>
@endsection

@section('breadcrumb')
   <li><a href="{{ url('home') }}"><i class="fa fa-dashboard"></i> Home</a></li>
   <li class="active">Team</li>
@endsection

@section('content')

  <!--[if lt IE 9]>
  <script src="https://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
  <![endif]-->
</head>
<body>



<h1>Dalam Perbaikan - Silakan kembali lagi nanti</h1>



  
Kami sedang melakukan update dan maintenance.
  
Silakan kembali lagi nanti</>
</body>
@endsection

@section('scripts')
@endsection