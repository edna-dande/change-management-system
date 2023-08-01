 <x-app-layout>
     <div class="container crequest">
         <h1>List of Requests</h1>
         <p>Manage your requests </p>

         <a href="{{ route('change_requests.create') }}" class="btn btn-primary">
             <span>
                    <font-awesome-icon icon="fa-solid fa-plus" style="color: #ffffff;"/>
             </span>
             <span class="create-text"> Create </span>
         </a>



         <table class="table">
             <thead>
             <tr>
                 <th>Title</th>
                 <th>Status</th>
                 <th>Request Date</th>
                 <th>Action</th>
             </tr>
             </thead>
             <tbody>
             @forelse ($changeRequests as $changeRequest)
                 <tr>
                     <td>{{ $changeRequest->title }}</td>
                     <td>
                         @if($changeRequest->status_id == 1 || $changeRequest->status_id == 2 || $changeRequest->status_id == 3)
                             <span class="btn btn-pending">{{ $changeRequest->status ? $changeRequest->status->name : 'N/A' }}</span>
                         @elseif($changeRequest->status_id == 7)
                             <span class="btn btn-progress">{{ $changeRequest->status ? $changeRequest->status->name : 'N/A' }}</span>
                         @elseif($changeRequest->status_id == 6)
                             <span class="btn btn-approved">{{ $changeRequest->status ? $changeRequest->status->name : 'N/A' }}</span>
                         @elseif($changeRequest->status_id == 5)
                             <span class="btn btn-rejected">{{ $changeRequest->status ? $changeRequest->status->name : 'N/A' }}</span>
                         @else
                             <span class="btn btn-complete">{{ $changeRequest->status ? $changeRequest->status->name : 'N/A' }}</span>
                         @endif
                     </td>
{{--                     <td>{{ $changeRequest->status->name }}</td>--}}
                     <td>{{ $changeRequest->created_at }}</td>
                     <td>
                         <a href="{{ route('change_requests.show', $changeRequest->id) }}" class="btn">
                             <font-awesome-icon icon="fa-solid fa-eye" />
                         </a>
                         @if(auth()->user()->id == $changeRequest->user_id)
                         <a href="{{ route('change_requests.edit', $changeRequest->id) }}" class="btn">
                             <font-awesome-icon icon="fa-solid fa-pen-to-square" />
                         </a>
                         <form action="{{ route('change_requests.destroy', $changeRequest->id) }}" method="POST" style="display: inline">
                             @csrf
                             @method('DELETE')
                             <button  class="btn" type="submit" onclick="return confirm('Are you sure you want to delete this change request?')">
                                 <font-awesome-icon icon="fa-solid fa-trash" style="color: #c4290e;" />
                             </button>
                         </form>
                         @endif
                     </td>
                 </tr>
             @empty
                 <tr><td colspan="4">No requests</td></tr>
             @endforelse
             </tbody>
         </table>

     </div>
 </x-app-layout>


