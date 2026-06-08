@if($state === 'is-locked')
    <svg aria-hidden="true" viewBox="0 0 24 24">
        <rect x="5" y="10" width="14" height="10" rx="2"></rect>
        <path d="M8 10V7a4 4 0 0 1 8 0v3"></path>
        <path d="M12 14v2"></path>
    </svg>
@elseif($state === 'is-completed')
    <svg aria-hidden="true" viewBox="0 0 24 24">
        <path d="m5 12 4 4L19 6"></path>
    </svg>
@elseif($type === 'quiz')
    <svg aria-hidden="true" viewBox="0 0 24 24">
        <path d="M8 21h8"></path>
        <path d="M12 17v4"></path>
        <path d="M7 4h10v4a5 5 0 0 1-10 0V4Z"></path>
        <path d="M17 5h3a3 3 0 0 1-3 3"></path>
        <path d="M7 5H4a3 3 0 0 0 3 3"></path>
    </svg>
@else
    <svg aria-hidden="true" viewBox="0 0 24 24">
        <path d="M4 5.5A2.5 2.5 0 0 1 6.5 3H20v16H6.5A2.5 2.5 0 0 0 4 21.5v-16Z"></path>
        <path d="M4 5.5A2.5 2.5 0 0 1 6.5 8H20"></path>
    </svg>
@endif
