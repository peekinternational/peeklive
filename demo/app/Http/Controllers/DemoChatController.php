<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\ChatFriends;
use App\ChatMessages;
use App\ChatStar;
use App\ArchivedChat;
use App\UnreadChat;
use App\DeleteChat;
use DB;
use Mail;
use Session;

class DemoChatController extends Controller
{
  public function index(){
    $user_id = Session::get('sender_data');
    $user_info = ChatFriends::where('sender_id', $user_id)->first();
    // dd($user_info);
    
    return view('chat', compact('user_info'));
  	}
    public function addFriends(Request $request){
      
      $new_message_group_id = mt_rand();
      $message_status = "empty";
      $sender_name = $request->input('sender_name');
      $sender_id = random_int(100,999);

      $friendsdata = [
        'receiver_id' => 0,
        'sender_id' => $sender_id,
        'receiver_name' => '',
        'sender_name' => $sender_name,
        'sender_email' => '',
        'receiver_email' => '',
        'receiver_image' => '',
        'sender_image' => '',
        'product_name' => '',
        'message_group_id' => $new_message_group_id,
        'message_status' => $message_status,
      ];
      
      
      
        $insertFriend = ChatFriends::create($friendsdata); 
        // DB::table('chat_friends')->insert($friendsdata);
        // dd($insertFriend->id);
        $conversation_id = $insertFriend->message_group_id;
        Session::put('sender_data', $insertFriend->sender_id);
        // Session::set('sender_data', $insertFriend->sender_id);
        session()->put('sender_data', $insertFriend->sender_id);
        return $conversation_id;
        // return redirect('/user/messages');

    }

    public function usersList(Request $request, $id){
     
      $getfriends = ChatFriends::with('messageData','starData:friend_id,star_by','archiveData:friend_id,archived_by','deleteData:friend_id,delete_by','unreadData:friend_id,unread_by')->where('id','!=',$id)->orderBy('id', 'DESC')->limit(10)->get();
      // dd($getf`riends);
      return $getfriends;

    }

    public function sendMessage(Request $request){
      $type = 0;
      $file = $request->file('file');
      if($file != ''){
        $type = 1;
      }else{
        $type = 0;
      }

      $is_group = 0;
      $group_id = 0;
      $group = $request->input('is_group');
      if($group != ''){
        $is_group = 1;
        $group_id = $request->input('group_id');
      }else{
        $is_group = 0;
        $group_id = 0;
      }
      $message_status = 'unread';
      // $message_status = $request->input('message_status');
      $msg_group_id = $request->input('message_group_id');
      
      $receiver_email = $request->input('receiver_email');
      $sender_email = $request->input('sender_email');

      $data = [
        'sender_id' => $request->input('sender_id'),
        'receiver_id' => $request->input('receiver_id'),
        'receiver_name' => $request->input('receiver_name'),
        'sender_name' => $request->input('sender_name'),
        'is_group' => $is_group,
        'group_id' => $group_id,
        'message' => $request->input('message'),
        'message_type' => $type,
        'message_status' => $message_status,
        'message_group_id' => $request->input('message_group_id'),
        'commentId' => $request->input('commentId'),
        'chatType' => $request->input('chatType'),
        'message_time' => $request->input('message_time'),
      ];
      // dd($data);
      if($file != ''){
        $filename= $file->getClientOriginalName();
        // $imagename= 'message-'.rand(000000,999999).'.'.$file->getClientOriginalExtension();
        $extension= $file->getClientOriginalExtension();
        if($extension == 'mp4' || $extension == 'webm' || $extension == 'mkv' || $extension == 'mov' || $extension == 'ogg'){
        	$data['file_type'] = 'video';
        }elseif($extension == 'pdf' || $extension == 'docx' || $extension == 'xlsx' || $extension == 'doc' || $extension == 'csv' || $extension == 'pptx' ||$extension == 'ppt'){
        	$data['file_type'] = 'document';

        }else{
        	$data['file_type'] = 'image';
        }
        $imagename= $filename;
        $destinationpath= public_path('chat_images');
        $file->move($destinationpath, $imagename);
        $data['file'] = $imagename;
      }
      // dd($data);
      if($file != '' || $request->input('message') != ''){
        $Insert = ChatMessages::create($data);
        $msg_id = $Insert->message_id;
        $time = $Insert->message_time;
        // print_r($msg_id);
        // dd($time);
        $friendData = [
          'message_status' => $message_status,
          'message_id' => $msg_id,
          'updatedByMsg' => $time,
        ];
        $updateFriend = ChatFriends::where('message_group_id', $msg_group_id)->update($friendData);
      }
    }

    public function fileSend(Request $request){

      // dd($request->input('commentId'));
      $type = 0;
      $file = $request->file('file');
      if($file != ''){
        $type = 1;
      }else{
        $type = 0;
      }

      $is_group = 0;
      $group_id = 0;
      $group = $request->input('is_group');
      if($group != ''){
        $is_group = 1;
        $group_id = $request->input('group_id');
      }else{
        $is_group = 0;
        $group_id = 0;
      }
      $message_status = 'unread';
      // $message_status = $request->input('message_status');
      $msg_group_id = $request->input('message_group_id');
      
      $receiver_email = $request->input('receiver_email');
      $sender_email = $request->input('sender_email');
      $data = [
        'sender_id' => $request->input('sender_id'),
        'receiver_id' => $request->input('receiver_id'),
        'receiver_name' => $request->input('receiver_name'),
        'sender_name' => $request->input('sender_name'),
        'is_group' => $is_group,
        'group_id' => $group_id,
        'message' => $request->input('message'),
        'message_type' => $type,
        'message_status' => $message_status,
        'message_group_id' => $request->input('message_group_id'),
        'commentId' => $request->input('commentId'),
        'chatType' => $request->input('chatType'),
        'message_time' => $request->input('message_time'),
      ];
      // dd($data);
      if($file != ''){
        $filename= $file->getClientOriginalName();
        // $imagename= 'message-'.rand(000000,999999).'.'.$file->getClientOriginalExtension();
        $extension= $file->getClientOriginalExtension();
        if($extension == 'mp4' || $extension == 'webm' || $extension == 'mkv' || $extension == 'mov'){
        	$data['file_type'] = 'video';
        }elseif($extension == 'pdf' || $extension == 'docx' || $extension == 'xlsx' || $extension == 'doc' || $extension == 'csv' || $extension == 'pptx' ||$extension == 'ppt'){
        	$data['file_type'] = 'document';

        }else{
        	$data['file_type'] = 'image';
        }
        $imagename= $filename;
        $destinationpath= public_path('chat_images');
        $file->move($destinationpath, $imagename);
        $data['file'] = $imagename;
      }
      // dd($data);
      if($file != '' || $request->input('message') != ''){
        $Insert = ChatMessages::create($data);
        $msg_id = $Insert->message_id;
        $time = $Insert->message_time;
        // print_r($msg_id);
        // dd($time);
        $friendData = [
          'message_status' => $message_status,
          'message_id' => $msg_id,
          'updatedByMsg' => $time,
        ];
        $updateFriend = ChatFriends::where('message_group_id', $msg_group_id)->update($friendData);
      }
      
    }

    public function single_chat(Request $request){

      $receiver_id = $request->input('receiver_id');
      $sender_id = $request->input('sender_id');

      $getsingleChat = DB::table('chat_messages')->orWhere(function($q) use ($sender_id, $receiver_id){
         $q->where('sender_id', $sender_id)
           ->where('receiver_id', $receiver_id);
    })->orWhere(function($h) use ($sender_id, $receiver_id){
         $h->where('sender_id', $receiver_id)
           ->where('receiver_id', $sender_id);
    })->get();
      // $getsingleChat = ChatMessages::where('message_group_id',$sender_id)->get();
      // dd($getsingleChat);
      return $getsingleChat;

    }

    public function allChats(Request $request){
      $getChats = ChatFriends::orderBy('friend_id', 'DESC')->get();
      return $getChats;
    }

    public function singleChatAll(Request $request){
      $message_group_id = $request->input('message_group_id');

      $allmessages = ChatMessages::where('message_group_id', $message_group_id)->get();

      return $allmessages;
    }

    public function deleteChat(Request $request){
      $message_group_id = $request->input('message_group_id');
      $deletedChat = ChatMessages::where('message_group_id',$message_group_id)->delete();
      return $deletedChat;
    }

    public function deleteAll(Request $request){
      
      ChatMessages::truncate();
      ChatFriends::truncate();
      return 0;
    }

    // Edit Message

    public function updateMessage(Request $request){
      // dd($request->all());
      $message_id = $request->input('id');
      $chatMessage = [
        "message" => $request->input('message')
      ];
      $updateMsg = ChatMessages::wheremessage_id($message_id)->update($chatMessage);
    }

    // Delete Message
    public function deleteMessage(Request $request, $id){
      // dd($id);
      $deleteMsg = ChatMessages::wheremessage_id($id)->update(['is_deleted'=>1]);
      return $deleteMsg;
    }
    
    // Star Conversation
    public function starChat(Request $request){
      $get_friend_data = ChatFriends::wheremessage_group_id($request->input('message_group_id'))->first();
      
      // dd($get_friend_data);
      $star = new ChatStar;
      $star->message_group_id = $request->input('message_group_id');
      $star->friend_id = $get_friend_data->id;
      $star->star_by = $request->input('user_id');
      $star->status = 'star';

      $data_save = $star->save();
      
      // $star = ChatFriends::wheremessage_group_id($message_group_id)->update(['receiver_star'=>$starBy]);
      
      return $star;
      
    }
    // UnStar Conversation
    public function unstarChat(Request $request){
      $unstar = ChatStar::where('star_by',$request->input('user_id'))->where('message_group_id',$request->input('message_group_id'))->delete();
      
      return $unstar;
    }
    // Star Conversation
    public function archiveChat(Request $request){
      $get_friend_data = ChatFriends::wheremessage_group_id($request->input('message_group_id'))->first();
      $archive = new ArchivedChat;
      $archive->message_group_id = $request->input('message_group_id');
      $archive->friend_id = $get_friend_data->id;
      $archive->archived_by = $request->input('user_id');
      $archive->status = 'archive';

      $data_save = $archive->save();
      
      // $star = ChatFriends::wheremessage_group_id($message_group_id)->update(['receiver_star'=>$starBy]);
      
      return $data_save;
      
    }
    // UnArchive Conversation
    public function unArchiveChat(Request $request){
      $unarchive = ArchivedChat::where('archived_by',$request->input('user_id'))->where('message_group_id',$request->input('message_group_id'))->delete();
      return $unarchive;
      
    }
    // Star Conversation
    public function deleteConv(Request $request){
      $get_friend_data = ChatFriends::wheremessage_group_id($request->input('message_group_id'))->first();
      // dd($request->input('user_id'));
      $delete = new DeleteChat;
      $delete->message_group_id = $request->input('message_group_id');
      $delete->friend_id = $get_friend_data->id;
      $delete->delete_by = $request->input('user_id');
      $delete->status = 'delete';

      $data_save = $delete->save();
      
      // $star = ChatFriends::wheremessage_group_id($message_group_id)->update(['receiver_star'=>$starBy]);
      
      return $data_save;
      
    }
    // Unread Conversation
    public function unreadConv(Request $request){
      $get_friend_data = ChatFriends::wheremessage_group_id($request->input('message_group_id'))->first();
      $unread = new UnreadChat;
      $unread->message_group_id = $request->input('message_group_id');
      $unread->friend_id = $get_friend_data->id;
      $unread->unread_by = $request->input('user_id');
      $unread->status = 'unread';

      $data_save = $unread->save();
      
      // $star = ChatFriends::wheremessage_group_id($message_group_id)->update(['receiver_star'=>$starBy]);
      
      return $data_save;
      
    }
    // Read Conversation
    public function readChat(Request $request){
      $read = UnreadChat::where('unread_by',$request->input('user_id'))->where('message_group_id',$request->input('message_group_id'))->delete();
      return $read;
      
    }


    // Chat Filters
    public function getArchiveChats(Request $request){
      $get_archive_data = ArchivedChat::wherearchived_by($request->input('user_id'))->select('message_group_id')->get()->toArray();
      // dd($get_archive_data);
      $getFRiends = ChatFriends::with('messageData','starData:friend_id,star_by','archiveData:friend_id,archived_by','deleteData:friend_id,delete_by','unreadData:friend_id,unread_by')->whereIn('message_group_id', $get_archive_data)->get();
      
      return $getFRiends;
    }

    public function getStarChats(Request $request){
      $get_star_data = ChatStar::wherestar_by($request->input('user_id'))->select('message_group_id')->get()->toArray();
      // dd($get_star_data);
      $getFRiends = ChatFriends::with('messageData','starData:friend_id,star_by','archiveData:friend_id,archived_by','deleteData:friend_id,delete_by','unreadData:friend_id,unread_by')->whereIn('message_group_id', $get_star_data)->get();
      
      return $getFRiends;
    }

    public function getUnreadChats(Request $request){
      $get_unread_data = UnreadChat::whereunread_by($request->input('user_id'))->select('message_group_id')->get()->toArray();
      // dd($get_unread_data);
      $getFRiends = ChatFriends::with('messageData','starData:friend_id,star_by','archiveData:friend_id,archived_by','deleteData:friend_id,delete_by','unreadData:friend_id,unread_by')->whereIn('message_group_id', $get_unread_data)->get();
      
      return $getFRiends;
    }

    public function logout(){
      Session::flush();
      Session::forget('sender_data');
      return redirect('demo/login');
    }
}
