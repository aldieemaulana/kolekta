<ul>
    <li class="{{ (Request::is('dashboard*')) ? 'active' : ''}}">
        <a href="{{ url('dashboard') }}">Dashboard</a>
    </li>
    <li class="{{ (Request::is('survey') || Request::is('survey/*')) ? 'active' : ''}}">
        <a href="{{ url('survey') }}">Survey</a>
    </li>
    <li class="{{ (Request::is('template*')) ? 'active' : ''}}">
        <a href="{{ url('template') }}">Template</a>
    </li>
    <li class="{{ (Request::is('surveyor*')) ? 'active' : ''}}">
        <a href="{{ url('surveyor') }}">Surveyor</a>
    </li>
    <li class="{{ (Request::is('responder*')) ? 'active' : ''}}">
        <a href="{{ url('responder') }}">Responder</a>
    </li>
</ul>