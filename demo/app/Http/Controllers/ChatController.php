<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ChatFriends;
use App\ChatMessages;
use App\ChatStar;
use App\ArchivedChat;
use App\UnreadChat;
use App\DeleteChat;
use DB;
use Mail;
use Session;

class ChatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      
    }

    public function send(Request $request){

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
      ];
      // dd($data);
      if($file != ''){
        $filename= $file->getClientOriginalName();
        // $imagename= 'message-'.rand(000000,999999).'.'.$file->getClientOriginalExtension();
        $extension= $file->getClientOriginalExtension();
        $imagename= $filename;
        $destinationpath= public_path('chat_images');
        $file->move($destinationpath, $imagename);
        $data['file'] = $imagename;
      }
      // dd($data);
      if($file != '' || $request->input('message') != ''){
        $Insert = ChatMessages::create($data);
        $msg_id = $Insert->message_id;
        $time = $Insert->created_at;
        // print_r($msg_id);
        // dd($time);
        $friendData = [
          'message_status' => $message_status,
          'message_id' => $msg_id,
          'updatedByMsg' => $time,
        ];
        $updateFriend = ChatFriends::where('message_group_id', $msg_group_id)->update($friendData);
      }
      // $toemail =  $receiver_email;
      // Mail::send('mail.buyer-order-email',['seller' =>$request->input('sender_name'), 'buyer'=>$request->input('receiver_name')],
      // function ($message) use ($toemail)
      // {

      //   $message->subject('ezvendors.com - New Message');
      //   $message->from('support@ezvendors.com', 'ezvendors.com');
      //   $message->to($toemail);
      // });
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
      ];
      // dd($data);
      if($file != ''){
        $filename= $file->getClientOriginalName();
        // $imagename= 'message-'.rand(000000,999999).'.'.$file->getClientOriginalExtension();
        $extension= $file->getClientOriginalExtension();
        $imagename= $filename;
        $destinationpath= public_path('chat_images');
        $file->move($destinationpath, $imagename);
        $data['file'] = $imagename;
      }
      // dd($data);
      if($file != '' || $request->input('message') != ''){
        $Insert = ChatMessages::create($data);
        $msg_id = $Insert->message_id;
        $time = $Insert->created_at;
        // print_r($msg_id);
        // dd($time);
        $friendData = [
          'message_status' => $message_status,
          'message_id' => $msg_id,
          'updatedByMsg' => $time,
        ];
        $updateFriend = ChatFriends::where('message_group_id', $msg_group_id)->update($friendData);
      }
      // $toemail =  $receiver_email;
      // Mail::send('mail.buyer-order-email',['seller' =>$request->input('sender_name'), 'buyer'=>$request->input('receiver_name')],
      // function ($message) use ($toemail)
      // {

      //   $message->subject('ezvendors.com - New Message');
      //   $message->from('support@ezvendors.com', 'ezvendors.com');
      //   $message->to($toemail);
      // });
    }

    public function friends(Request $request){
      
      $new_message_group_id = mt_rand();
      $message_status = "empty";
      $receiver_id = $request->input('receiver_id');
      $sender_id = $request->input('sender_id');
      $product_id = $request->input('product_id');

      $friendsdata = [
        'receiver_id' => $request->input('receiver_id'),
        'sender_id' => $request->input('sender_id'),
        'product_id' => $request->input('product_id'),
        'receiver_name' => $request->input('receiver_name'),
        'sender_name' => $request->input('sender_name'),
        'sender_email' => $request->input('sender_email'),
        'receiver_email' => $request->input('receiver_email'),
        'receiver_image' => $request->input('receiver_image'),
        'sender_image' => $request->input('sender_image'),
        'product_name' => $request->input('product_name'),
        'message_group_id' => $new_message_group_id,
        'message_status' => $message_status,
      ];
      
      $getfriends = DB::table('chat_friends')->orWhere(function($q) use ($sender_id, $receiver_id,$product_id){
         $q->where('sender_id', $sender_id)
           ->where('receiver_id', $receiver_id)
           ->where('product_id', $product_id);
      })->orWhere(function($h) use ($sender_id, $receiver_id,$product_id){
         $h->where('sender_id', $receiver_id)
           ->where('receiver_id', $sender_id)
           ->where('product_id', $product_id);
      })->get();
      
      if(count($getfriends) == ''){
        session()->put('single_message_id', $new_message_group_id);
       session(['single_message_id' => $new_message_group_id]);
        $insertFriend = ChatFriends::create($friendsdata); 
        // DB::table('chat_friends')->insert($friendsdata);
        $conversation_id = $insertFriend->message_group_id;
        // return response()->json(
        //     [
        //         'success' => true,
        //         'message' => 'Data inserted successfully'
        //     ]
        // );
        return $conversation_id;
      }else{
       $old_message_group_id = $getfriends[0]->message_group_id;
       Session::put('single_message_id', $old_message_group_id);
       session()->put('single_message_id', $old_message_group_id);
        Session(['single_message_id' => $old_message_group_id]);
        return $old_message_group_id;
        // return redirect('/user/messages');
      }

    }
  
   
  	public function filterFriendsList(Request $request, $id){

      // $getfriends = ChatFriends::orWhere('sender_id',$id)->orWhere('receiver_id',$id)->orderBy('friend_id', 'DESC')->get();
      $filterFriend = ChatFriends::with('messageData')->orWhere('sender_id',$id)->orWhere('receiver_id',$id)->orderBy('friend_id', 'DESC')->get();

      // $filterFriend = DB::table('chat_friends')
      //       ->select('chat_friends.*', 'users.first_name')
      //       ->join('users', 'users.id', '=', 'chat_friends.sender_id')
      //       ->join('users', 'users.id', '=', 'chat_friends.receiver_id')->orWhere('chat_friends.sender_id',$id)->orWhere('chat_friends.receiver_id',$id)->get();

      return $filterFriend;

    }
  


    public function friendsList(Request $request, $id){

      // $getfriends = ChatFriends::with('messageData','friendData')->orWhere('sender_id',$id)->orWhere('receiver_id',$id)->orderBy('friend_id', 'DESC')->get();
      $getfriends = ChatFriends::with('messageData','starData:friend_id,star_by','archiveData:friend_id,archived_by','deleteData:friend_id,delete_by','unreadData:friend_id,unread_by')->orWhere('sender_id',$id)->orWhere('receiver_id',$id)->orderBy('friend_id', 'DESC')->get();
      // $getfriends = ChatFriends::with(
      //   array('friendData' => function($query) {
      //   $query->select('action_to','status');
      // }))->with('messageData')->orWhere('sender_id',$id)->orWhere('receiver_id',$id)->orderBy('friend_id', 'DESC')->get();
      // $getfriends = DB::table('chat_friends')
      // ->select('chat_friends.*','chat_stars.star_by','chat_messages.*')
      // ->join('chat_stars','chat_stars.friend_id','=','chat_friends.friend_id')
      // ->join('chat_messages', 'chat_messages.message_id', '=', 'chat_friends.message_id')
      // ->orWhere('chat_friends.sender_id',$id)->orWhere('chat_friends.receiver_id',$id)->orderBy('friend_id', 'DESC')->get();

      // $getfriends = DB::table('chat_friends')
      // ->select('chat_friends.*', 'chat_stars.message_group_id')
      // ->join('chat_stars', 'chat_stars.message_group_id', '=', 'chat_friends.message_group_id')
      // ->get();
      // dd($getfriends);
      return $getfriends;

    }


    public function singleChat(Request $request){

      $receiver_id = $request->input('receiver_id');
      $sender_id = $request->input('sender_id');

    //   $getsingleChat = DB::table('chat_messages')
    //    ->orWhere(function($q) use ($sender_id, $receiver_id){
    //      $q->where('sender_id', $sender_id)
    //        ->where('receiver_id', $receiver_id);
    // })->orWhere(function($h) use ($sender_id, $receiver_id){
    //      $h->where('sender_id', $receiver_id)
    //        ->where('receiver_id', $sender_id);
    // })->get();
      $getsingleChat = ChatMessages::where('message_group_id',$sender_id)->get();
      // dd($getsingleChat);
      return $getsingleChat;

    }

    public function seenMessage(Request $request){

      $receiver_id = $request->input('receiver_id');
      $sender_id = $request->input('sender_id');
      // dd($receiver_id);
    //   $getsingleChat = DB::table('chat_messages')
    //    ->orWhere(function($q) use ($receiver_id){
    //      $q->where('receiver_id', $receiver_id);
    // })->orWhere(function($h) use ($sender_id, $receiver_id){
    //      $h->where('sender_id', $receiver_id)
    //        ->where('receiver_id', $sender_id);
    // })->update(['message_status', 'seen']);
    //   dd($getsingleChat);

      $seenMsg = ChatMessages::where('sender_id',$receiver_id)->update(['message_status'=>'seen']);

      return $seenMsg;

    }

    public function messsageCount(Request $request){

      $receiver_id = $request->input('receiver_id');
      $sender_id = $request->input('sender_id');

      // dd($sender_id);
    //   $getsingleChat = DB::table('chat_messages')
    //    ->orWhere(function($q) use ($receiver_id){
    //      $q->where('receiver_id', $receiver_id);
    // })->orWhere(function($h) use ($receiver_id){
    //      $h->where('sender_id', $receiver_id);
    // })->where('message_status', 'unread')->get();

    $msgCountGet = ChatMessages::where('receiver_id',$receiver_id)->where('message_status','unread')->get();
    // dd($msgCountGet);
    $wordCount = count($msgCountGet);
      // dd($wordCount);
      return $wordCount;

    }

    // Get All Chats

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
      $star->friend_id = $get_friend_data->friend_id;
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
      $archive->friend_id = $get_friend_data->friend_id;
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
      $delete->friend_id = $get_friend_data->friend_id;
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
      $unread->friend_id = $get_friend_data->friend_id;
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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
