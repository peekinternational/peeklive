<template>
    <div class="">
      <div class="content-grid padding-new p-0">
        <audio id="messagetone" muted>
          <source src="https://www.ezvendors.com/chat/public/img/bell.mp3" type="audio/ogg">
          <source src="https://www.ezvendors.com/chat/public/img/bell.mp3" type="audio/mpeg">
        </audio>
        <!-- GRID -->
        <div class="grid grid-3-12 medium-space row m-3">
          <!-- GRID COLUMN -->
          <div class="account-hub-content">
            <!-- <div class="section-header">
              <div class="section-header-info">
                <h2 class="section-title">Messages</h2>
              </div>
            </div> -->
            <!-- CHAT WIDGET WRAP -->
            <div class="chat-widget-wrap">
              <div class="chat-widget static col-md-3 p-0">
                <ul class="nav nav-tabs nav-justified chat-tabs" id="myTab" role="tablist">
                  <li class="nav-item">
                    <!-- <a class="nav-link active font-weight-bold border-bottom" id="friends-tab" data-toggle="tab" href="#friends" role="tab" aria-controls="friends" aria-selected="true">All Conversations</a> -->
                    <div class="d-flex justify-content-between align-items-center px-2 py-3">
                      <div class="custom-select-box">
                        <select class="select-converation form-control border-0" @change="getChats($event)">
                          <option value="all">All Conversation</option>
                          <option value="unread">Unread</option>
                          <option value="star">Starred</option>
                          <option value="archive">Archived</option>
                        </select>
                      </div>
                      <div>
                        <span><i class="fa fa-search"></i></span>
                      </div>
                    </div>
                  </li>

                  <!-- <li class="nav-item">
                    <a class="nav-link" id="groups-tab" data-toggle="tab" href="#groups" role="tab" aria-controls="groups" aria-selected="false">Groups</a>
                  </li> -->
                </ul>
                <form class="chat-widget-form">
                  <div class="interactive-input small">
                    <input type="text" id="chat-widget-search-2" v-model="userSearch" placeholder="Search Messages...">
                    <div class="interactive-input-icon-wrap">
                      <svg class="interactive-input-icon icon-magnifying-glass">
                        <use xlink:href="#svg-magnifying-glass"></use>
                      </svg>
                    </div>
                    <div class="interactive-input-action">
                      <svg class="interactive-input-action-icon icon-cross-thin">
                        <use xlink:href="#svg-cross-thin"></use>
                      </svg>
                    </div>
                  </div>
                </form>
                <div class="tab-content" id="myTabContent">
                  <div class="tab-pane fade show active" id="friends" role="tabpanel" aria-labelledby="friends-tab">
                    <div v-if="friendData">
                      <div class="chat-widget-messages">
                        <div class="chat-widget-message user-list-item" :id="friends.message_group_id" v-for="friends in orderedUsers" @click="getSingleChat(friends)">
                          <div class="user-status">
                            <template v-if="friends.sender_id == userdata">
                              <div class="user-status-avatar">
                                <div class="user-img">
                                  <div class="user-avatar-content">
                                    <template v-if="friends.receiver_image != ''">
                                      <div class="hexagon-image-30-32" data-src="'img/user.png'"><img :src="'img/user.png'"></div> 
                                    </template>
                                    <template v-else>
                                      <div class="hexagon-image-30-32" data-src="'img/user.png'"><img :src="'img/user.png'"></div>
                                    </template>
                                  </div>
                                </div>
                              </div>
                            </template>
                            <template v-else>
                              <div class="user-status-avatar">
                                <div class="user-img">
                                  <div class="user-avatar-content">
                                    <template v-if="friends.sender_image != ''">
                                      <div class="hexagon-image-30-32" data-src="'img/profileimage/'+friends.sender_image"><img :src="'img/user.png'"></div>
                                    </template>
                                    <template v-else>
                                      <div class="hexagon-image-30-32" data-src="img/user.png"><img src="'img/user.png'"></div>
                                    </template>
                                  </div>
                                </div>
                              </div>
                            </template>
                            <p class="user-status-title">
                              <template v-if="friends.sender_id == userdata">
                                <span class="bold">{{friends.receiver_name}} </span>
                              </template>
                              <template v-else>
                                <span class="bold">{{friends.sender_name}} </span>
                              </template>
                            </p>
                            <div :class="'lastMessage-'+friends.message_group_id">
                              <template v-if="userdata == friends.sender_id">
                                <p :id="'f_typing'+friends.receiver_id" v-if="friends.message_id != 0" class="user-status-text">{{friends.message_data.message}}</p>
                              </template>
                              <template v-else>
                                <p :id="'f_typing'+friends.sender_id" v-if="friends.message_id != 0" class="user-status-text">{{friends.message_data.message}}</p>
                              </template>
                            </div>
                            <!-- <p class="user-status-text">Great! Then we'll meet with them at the party...</p> -->
                            <p class="user-status-timestamp floaty">{{istoday(friends.updatedByMsg)}} 
                              <span v-if="friends.star_data != ''">
                                <span v-for="star in friends.star_data">
                                  <span v-if="star.star_by == userdata">
                                  
                                    <i class="fa fa-star active-star"></i>
                                
                                  </span>
                                  <span v-else>
                                    <i class="fa fa-star-o"></i>
                                 
                                  </span>
                                </span>
                              </span>
                              <span v-else>
                                <i class="fa fa-star-o"></i>
                              </span>
                              
                              
                            </p>
                            <!-- {{friends.unread_data}} -->
                            <p class="position-absolute" :class="'unread-'+friends.message_group_id "  v-for="unread in friends.unread_data" style="right: 0; top: 30px;">
                              <span v-if="unread.unread_by == userdata">  
                                <span class="badge badge-danger">1</span>&nbsp;<span class="fa fa-envelope-o"></span>
                              </span>
                            </p>
                          </div>
                        </div>
                        <!-- CHAT WIDGET MESSAGE -->
                      </div>
                    </div>  
                    <div v-if="userSearching">
                      <div class="chat-widget-messages">
                        <div class="chat-widget-message user-list-item" :id="friends.message_group_id" v-for="friends in filteredFriendlist" @click="getSingleChat(friends)">
                          <div class="user-status">
                            <template v-if="friends.sender_id == userdata.id">
                              <div class="user-status-avatar">
                                <div class="user-img">
                                  <div class="user-avatar-content">
                                    <template v-if="friends.receiver_info.profileimage != ''">
                                      <div class="hexagon-image-30-32" data-src="'/dashboard-assets/img/profileimage/'+friends.receiver_info.profileimage"><img :src="'/dashboard-assets/img/profileimage/'+friends.receiver_info.profileimage"></div>
                                    </template>
                                    <template v-else>
                                      <div class="hexagon-image-30-32" data-src="'img/user.png'"><img src="'img/user.png'"></div>
                                    </template>
                                  </div>
                                </div>
                              </div>
                            </template>
                            <template v-else>
                              <div class="user-status-avatar">
                                <div class="user-img">
                                  <div class="user-avatar-content">
                                    <template v-if="friends.sender_info.profileimage != ''">
                                      <div class="hexagon-image-30-32" data-src="'/dashboard-assets/img/profileimage/'+friends.sender_info.profileimage"><img :src="'/dashboard-assets/img/profileimage/'+friends.sender_info.profileimage"></div>
                                    </template>
                                    <template v-else>
                                      <div class="hexagon-image-30-32" data-src="'img/user.png'"><img src="'img/user.png'"></div>
                                    </template>
                                  </div>
                                </div>
                              </div>
                            </template>
                            <p class="user-status-title">
                              <template v-if="friends.sender_id == userdata">
                                <span class="bold">{{friends.receiver_name}} </span>
                              </template>
                              <template v-else>
                                <span class="bold">{{friends.sender_name}} </span>
                              </template>
                            </p>
                            <div :class="'lastMessage-'+friends.message_group_id">
                              <template v-if="userdata == friends.sender_id">
                                <p :id="'f_typing'+friends.receiver_id" v-if="friends.message_id != 0" class="user-status-text">{{friends.message_data.message}}</p>
                              </template>
                              <template v-else>
                                <p :id="'f_typing'+friends.sender_id" v-if="friends.message_id != 0" class="user-status-text">{{friends.message_data.message}}</p>
                              </template>
                            </div>
                            <p class="user-status-timestamp floaty">{{istoday(friends.updatedByMsg)}} 
                              <span v-if="friends.star_data != ''">
                                <span v-for="star in friends.star_data">
                                  <span v-if="star.star_by == userdata">
                                  
                                    <i class="fa fa-star active-star"></i>
                                
                                  </span>
                                  <span v-else>
                                    <i class="fa fa-star-o"></i>
                                 
                                  </span>
                                </span>
                              </span>
                              <span v-else>
                                <i class="fa fa-star-o"></i>
                              </span>

                            </p>
                            
                          </div>
                        </div>
                        <!-- CHAT WIDGET MESSAGE -->
                      </div>
                    
                    </div>

                  </div>
                </div>
                <!-- /CHAT WIDGET MESSAGES -->
                <!-- CHAT WIDGET FORM -->
                <!-- /CHAT WIDGET FORM -->
              </div>
              <!-- /CHAT WIDGET -->

              <!-- CHAT WIDGET -->
              <div class="chat-widget message-body col-md-9 p-0">
                <center id="selectConversation" class="h-100 justify-content-center align-items-center" style="display: flex;" >
                  <div class="d-block">
                    <img src="img/eventLogo.png" width="180" alt="">
                    <h3 class="mt-3 empty-heading" style="font-weight:400;">Wosom Chat</h3>
                  </div>
                  <!-- <p class="lead">Try selecting a conversation or searching for someone specific.</p> -->
                </center>
                <div id="startchat" style="display: none;">
                  <div class="chat-widget-header">
                  <div class="d-flex justify-content-between align-items-center">
                    <div class="user-data">
                      <span class="closeMsg d-lg-none d-md-none"><i class="fa fa-chevron-left"></i></span>
                      <div class="user-status pl-0 d-flex align-items-center">
                        <div class="user-img">
                          <template v-if="friendImage != ''">
                            <div class="hexagon-image-30-32" data-src="'img/profileimage/'+friendImage"><img :src="'img/user.png'"></div>
                          </template>
                          <template v-else>
                          <div class="hexagon-image-30-32" data-src="img/user.png"><img src="'img/user.png'"></div>
                          </template>
                        </div>
                        <p class="user-status-title pl-3"><span class="bold">{{friendName}} </span></p>
                        <!-- <p class="user-status-tag online">Online</p> -->
                      </div>
                    </div>
                    <div class="user-action d-flex align-items-center">
                      <a href="javascript:void(0);" class="menu-btn"><i class="fa fa-ellipsis-h" aria-hidden="true"></i></a>
                      <div class="action-btn" style="display: none;">
                        <a href="javascript:void(0);" data-toggle="tooltip" data-placement="bottom" title="Star" class="star_convo" @click="star(userdata,message_group_id)" v-if="starBy != userdata"><i class="fa fa-star-o"></i></a>
                        <a href="javascript:void(0);" data-toggle="tooltip" data-placement="bottom" title="Unstar" class="star_convo" @click="unStar(userdata,message_group_id)" v-if="starBy == userdata"><i class="fa fa-star active-star"></i></a>
                        <a href="javascript:void(0);" data-toggle="tooltip" data-placement="bottom" title="Mark as Unread" @click="unreadConv(userdata,message_group_id)"><i class="fa fa-envelope-o" aria-hidden="true"></i></a>
                        <a href="javascript:void(0);" data-toggle="tooltip" data-placement="bottom" title="Move to Archive" @click="archive(userdata,message_group_id)" v-if="archiveBy != userdata"><i class="fa fa-archive" aria-hidden="true"></i></a>
                        <a href="javascript:void(0);" data-toggle="tooltip" data-placement="bottom" title="Move to Inbox" @click="unArchive(userdata,message_group_id)" v-if="archiveBy == userdata"><i class="fa fa-inbox" aria-hidden="true"></i></a>
                        <a href="javascript:void(0);" data-toggle="tooltip" data-placement="bottom" title="Delete" @click="deleteChat(userdata,message_group_id)"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="row mx-0">
                  <div class="col-md-9 pl-0 pr-0 border-right">
                    <!-------- Dropzone ------>
                    <vue-dropzone ref="myVueDropzone" @ondragleave="dragLeave(event)" id="dropzone" @vdropzone-success="afterComplete" v-on:vdropzone-sending="dragfileupload" :options="dropzoneOptions"> </vue-dropzone>
                    <!-------- end -------->
                    

                    <div>
                      <!-- /CHAT WIDGET HEADER -->
                      <!-- CHAT WIDGET CONVERSATION -->
                      <div class="chat-widget-conversation">
                        <div class="chat-widget-speaker right send_message_list d-flex flex-row justify-content-end align-items-center" v-for=" chat in singleChate"  v-if="chat.sender_id == userdata">
                          <div class="msg_container text-right order-1">
                            <template v-if="chat.message !== ''">
                                <p class="chat-widget-speaker-message" v-if="chat.is_deleted == 1">message deleted</p>
                                <p class="chat-widget-speaker-message" v-else-if="chat.message != '' && chat.chatType == 0">{{chat.message}}</p>
                                <p class="mb-0 chat-widget-speaker-message" v-else-if="chat.messageType != 1 && chat.messageType != 2 && chat.chatType == 1" :id="'sender'+chat.message_id">
                                  <span class="mb-2 d-block">‘‘{{chat.commentId}}’’</span> <span class="reply-msg">{{ chat.message }}</span>
                                </p>
                            </template>
                            <template v-if="chat.message_type == 1 && chat.is_deleted != 1">
                              <div>
                                <img :src="'chat_images/'+chat.file" alt="..." class="img-thumbnail" width="100">
                              </div>
                              
                              <a :href="'chat_images/'+chat.file" download class="d-block mt-2 ml-1"  style="color: #ff0707;">
                              <i class="fa fa-download"></i> {{chat.file}}
                              </a>
                            </template>
                            <p class="chat-widget-speaker-timestamp text-right">{{istoday(chat.created_at)}}</p>
                          </div>
                          <div class="pt-1 position-relative justify-content-between align-items-center edit-section order-0" v-if="chat.is_deleted != 1">
                            <span class="msg-setting" :id="'msg-setting'+chat.message_id" @click="msg_setting(chat.message_id)">
                              <i class="fa fa-ellipsis-h edit"></i>
                            </span>
                            <ul class="position-absolute list-group rounded border edit-option" style="width: 170px;z-index: 999;display: none; right: -28px;" :id="'msg-dropdown'+chat.message_id">
                              <li class="list-group-item py-2 px-3 border-0">
                                <a href="#" class="text-secondary border-bottom d-block pb-2" @click="eidtchat(chat.message_id,chat.message)">
                                  <i class="fa fa-edit pr-1"></i>
                                  <span>Edit</span>
                                </a>
                              </li>
                              <li class="list-group-item py-2 px-3 border-0">
                                <a href="javascript:void(0);" class="text-secondary border-bottom d-block pb-2" @click="msgdelete(chat)">
                                  <i class="fa fa-trash pr-1"></i>
                                  <span>Delete</span>
                                </a>
                              </li>
                              <li class="list-group-item py-2 px-3 border-0">
                                <a href="#" class="text-secondary border-bottom d-block pb-2" @click="quote(chat)">
                                  <i class="fa fa-reply pr-1"></i>
                                  <span>Reply</span>
                              </a>
                              </li>
                              <li class="list-group-item py-2 px-3 border-0">
                                <a href="#" class="text-secondary border-bottom d-block pb-2" @click="copymsg(chat.message)" v-clipboard:copy="messagecopy" v-clipboard:success="onCopy" v-clipboard:error="onError">
                                  <i class="fa fa-clipboard pr-1"></i>
                                  <span>Copy</span>
                                </a>
                              </li>
                            </ul>
                          </div>
                        </div>
                        <div class="chat-widget-speaker left recieve_message_list d-flex align-items-start flex-row align-items-center" v-else>
                          <div class="chat-widget-speaker-avatar">
                            <div class="user-avatar tiny no-border">
                              <div class="user-avatar-content">
                                <template v-if="friendImage != ''">
                                  <div class="hexagon-image-24-26" data-src="'/img/profileimage/'+friendImage"><img :src="'img/user.png'"></div>
                                </template>
                                <template v-else>
                                <div class="hexagon-image-24-26" data-src="'/img/user.png'"><img :src="'img/user.png'"></div>
                                </template>
                              </div>
                            </div>
                          </div>
                          <div class="msg_container">
                            <template v-if="chat.message != ''">
                              <p v-if="chat.is_deleted == 1" class="chat-widget-speaker-message">message deleted</p>
                              <p class="chat-widget-speaker-message" v-else-if="chat.message != '' && chat.chatType == 0">{{chat.message}}</p>
                              <p class="mb-0 chat-widget-speaker-message" v-else-if="chat.chatType == 1" :id="'sender'+chat.message_id">
                                <span class="mb-2 d-block">‘‘{{chat.commentId}}’’</span> <span class="reply-msg" style="background-color: #dfdfe2;">{{ chat.message }}</span>
                              </p>
                            </template>
                            <template v-if="chat.message_type == 1 && chat.is_deleted != 1">
                              <div>
                                <img :src="'chat_images/'+chat.file" alt="..." class="img-thumbnail" width="100">
                              </div>
                              <a :href="'chat_images/'+chat.file" download class="d-block mt-2 ml-1"  style="color: #ff0707;">
                              <i class="fa fa-download"></i> {{chat.file}}
                              </a>
                            </template>
                            <p class="chat-widget-speaker-timestamp">{{istoday(chat.created_at)}}</p>
                          </div>
                          <div class="pt-1 position-relative justify-content-between align-items-center reply-section" v-if="chat.is_deleted != 1">
                            <span class="msg-setting" :id="'msg-setting'+chat.message_id" @click="msg_setting(chat.message_id)">
                              <i class="fa fa-ellipsis-h reply"></i>
                            </span>
                            <ul class="position-absolute list-group rounded border reply-option" style="width: 150px;z-index: 999;left: -32px; display: none;" :id="'msg-dropdown'+chat.message_id">
                              <li class="list-group-item py-2 px-3 border-0">
                                <a href="javascript:void(0);" class="text-secondary border-bottom d-block pb-2" @click="quote(chat)">
                                  <i class="fa fa-reply pr-1"></i>
                                  <span>Reply</span>
                                </a>
                              </li>
                              <li class="list-group-item py-2 px-3 border-0">
                                <a href="#" class="text-secondary border-bottom d-block pb-2" @click="copymsg(chat.message)" v-clipboard:copy="messagecopy" v-clipboard:success="onCopy" v-clipboard:error="onError">
                                  <i class="fa fa-clipboard pr-1"></i>
                                  <span>Copy</span>
                                </a>
                              </li>
                              <!-- <li class="list-group-item py-2 px-3 border-0">
                                <a href="" class="text-secondary border-bottom d-block pb-2">
                                  <i class="fa fa-trash pr-1"></i>
                                  <span>Delete</span>
                                </a>
                              </li> -->
                            </ul>
                          </div>
                        </div>
                        <!-- CHAT WIDGET SPEAKER -->
                      </div>
                      <!-- /CHAT WIDGET CONVERSATION -->

                      <!-- CHAT WIDGET FORM -->
                      <!-- <form class="chat-widget-form"> -->
                      <div class="chat-widget-form">
                                
                        <div class="form-row split">
                          <div class="form-item position-relative">
                            <input type="hidden" name="sender_id" v-model="sender_id">
                            <input type="hidden" name="receiver_id" v-model="receiver_id">
                            <input type="hidden" name="receiver_name" v-model="receiver_name" >
                            <div class="position-absolute w-100 m-auto replyArea px-2 py-2 replybox" style="top: -50px;" v-if="replyBox == true">
                              <p class="mb-2">‘‘{{chatreplydata.message}}’’</p>
                              <span class="closeReplybox" @click="closeReplybox()">
                                x
                              </span>
                              <span>{{chatTime(chatreplydata.createdAt)}}</span>
                            </div>
                            <div class="interactive-input small">
                              <input type="text" id="send_message" v-model="message" placeholder="Write a message..." @keyup.enter="sendMessage()">
                              <emoji-picker @emoji="append" :search="search">
                                <div
                                  class="emoji-invoker"
                                  slot="emoji-invoker"
                                  slot-scope="{ events: { click: clickEvent } }"
                                  @click.stop="clickEvent"
                                >
                                  <svg height="24" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M0 0h24v24H0z" fill="none"/>
                                    <path d="M11.99 2C6.47 2 2 6.48 2 12s4.47 10 9.99 10C17.52 22 22 17.52 22 12S17.52 2 11.99 2zM12 20c-4.42 0-8-3.58-8-8s3.58-8 8-8 8 3.58 8 8-3.58 8-8 8zm3.5-9c.83 0 1.5-.67 1.5-1.5S16.33 8 15.5 8 14 8.67 14 9.5s.67 1.5 1.5 1.5zm-7 0c.83 0 1.5-.67 1.5-1.5S9.33 8 8.5 8 7 8.67 7 9.5 7.67 11 8.5 11zm3.5 6.5c2.33 0 4.31-1.46 5.11-3.5H6.89c.8 2.04 2.78 3.5 5.11 3.5z"/>
                                  </svg>
                                </div>
                                <div slot="emoji-picker" slot-scope="{ emojis, insert, display }">
                                  <div class="emoji-picker" :style="{ top: display.y + 'px', left: display.x + 'px' }">
                                    <div class="emoji-picker__search">
                                      <input type="text" v-model="search" v-focus>
                                    </div>
                                    <div>
                                      <div v-for="(emojiGroup, category) in emojis" :key="category">
                                        <h5>{{ category }}</h5>
                                        <div class="emojis">
                                          <span
                                            v-for="(emoji, emojiName) in emojiGroup"
                                            :key="emojiName"
                                            @click="insert(emoji)"
                                            :title="emojiName"
                                          >{{ emoji }}</span>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </emoji-picker>
                              <label for="file" class="interactive-input-icon-wrap actionable">
                                <div class="interactive-input-icon-wrap actionable">
                                  <input type="file" ref="msg_file" id="file" hidden="" @change="uploadfile($event)" multiple />
                                  <div class="tooltip-wrap text-tooltip-tft" data-title="Send Photo">
                                    <svg class="interactive-input-icon icon-camera">
                                      <use xlink:href="#svg-camera"></use>
                                    </svg>
                                    <svg class="interactive-input-icon icon-camera" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M5 5h-3v-1h3v1zm8 5c-1.654 0-3 1.346-3 3s1.346 3 3 3 3-1.346 3-3-1.346-3-3-3zm11-4v15h-24v-15h5.93c.669 0 1.293-.334 1.664-.891l1.406-2.109h8l1.406 2.109c.371.557.995.891 1.664.891h3.93zm-19 4c0-.552-.447-1-1-1-.553 0-1 .448-1 1s.447 1 1 1c.553 0 1-.448 1-1zm13 3c0-2.761-2.239-5-5-5s-5 2.239-5 5 2.239 5 5 5 5-2.239 5-5z"/></svg>
                                  </div>
                                </div>
                              </label>
                              <div class="interactive-input-action">
                                <svg class="interactive-input-action-icon icon-cross-thin">
                                  <use xlink:href="#svg-cross-thin"></use>
                                </svg>
                              </div>
                            </div>
                          </div>
                          <div class="form-item auto-width">
                            <button class="button primary padded send-message" @click="sendMessage" id="send-msg">
                              <i class="fa fa-paper-plane" aria-hidden="true"></i>
                              <!-- <svg class="button-icon no-space icon-send-message">
                                <use xlink:href="#svg-send-message"></use>
                              </svg> -->
                            </button>
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- </form> -->
                  </div>
                  <div class="col-md-3">
                    <div class="about_info mt-3">
                      <h5>About</h5>
                      <div class="about_img rounded-circle mx-auto mt-5">
                        <img src="img/user.png" class="rounded-circle">
                      </div>
                      <h5 class="text-center font-weight-bold mt-4">{{friendName}} </h5>
                      <!-- <div class="d-flex justify-content-between my-4">
                        <p>Reviews</p>
                        <p class="font-weight-bold"><i class="fa fa-star"></i> 4.9(13)</p>
                      </div> -->
                      <div class="d-flex justify-content-between my-4">
                        <p>Avg. Response Time</p>
                        <p class="font-weight-bold">1h</p>
                      </div>
                      <div class="d-flex justify-content-between my-4">
                        <p>From</p>
                        <p class="font-weight-bold">English</p>
                      </div>
                      <div class="d-flex justify-content-between my-4">
                        <p>English</p>
                        <p class="font-weight-bold">Fluent</p>
                      </div>
                    </div>
                  </div>
                </div>
                </div>
              </div>
            </div>
            <!-- /CHAT WIDGET WRAP -->
          </div>
          <!-- /GRID COLUMN -->
        </div>
        <!-- /GRID -->
      </div>
      <!-- /CONTENT GRID -->
      <!-- Modal -->
    </div>
    
</template>
<script>
      import moment from 'moment';
      // import VEmojiPicker from 'v-emoji-picker';
      import EmojiPicker from 'vue-emoji-picker';
      import VueClipboard from 'vue-clipboard2'
      import Toasted from 'vue-toasted';
      import vueDropzone from 'vue2-dropzone';
      Vue.use(EmojiPicker);
      Vue.use(VueClipboard);
      Vue.use(Toasted);
      var socket = io.connect('https://peekvideochat.com:22000/');
    export default {
        name: 'ExampleComponent',
        components: { EmojiPicker,vueDropzone },
        props: [
          'userdata',
          'user_name',
        ],
        data: function() {
            return {
                dataMessages: [],
                message: "",
                sender_id: "",
                receiver_id: "",
                receiver_name: "",
                ads_id: "1",
                file: "",
                users: "",
                error: "",
                userr: "",
                friendList: [],
                allFriends: [],
                singleChate: [],
                singleChatUser: "",
                friendName:"",
                user_names:"",
                friendId:"",
                friendImage:"",
                productName:"",
                userEmail:"",
                friendEmail:"",
                chatWithRefId:"",
                ischatemojiActive:false,
                search: '',
                havegroup:false,
                groupName:'',
                multiplemembers:[],
                multipleneewmembers:[],
                groupData: {},
                userGroups: [],
                groupmessage: '',
                groupmsgObj: {},
                groupchatdata: [],
                singlegroup: {},
                groupdata: {},
                friendData:true,
                userSearching:false,
                userSearch: '',
                singleChatSearch: false,
                singleChatData:  true,
                messageSearch: '',
                userdec: {},
                messagecopy: '',
                replyBox: false,
                chatreplydata: {},
                editChatid: '',
                onEditclear: false,
                chatType: '',
                dropzoneOptions: {
                  url: 'api/fileShare',
                  thumbnailWidth: 100,
                  thumbnailHeight: 100,
                  maxFiles: 10,
                  maxFilesize: 420,
                  chunking: true,
                  headers: { "My-Awesome-Header": "header value" }
                },
                starBy: "",
                deleteBy: "",
                archiveBy: "",
                unreadBy: "",
            }
        },
        sockets: {
          connect: function() {
            console.log('socket connected successfully')
          },

          disconnect() {
            console.log('socket disconnected')
          },

          peekStartTyping(data) {
              console.log('jlkjkjkj'+data);
            this.typing = true;
            // console.log(this.typing);
              const post = this.friendList.filter((obj) => {
                    return data.selectFrienddata === obj.receiver_id;
                  }).pop();
                  
                    console.log('dddd'+post);
                if(post){
                        if (this.friendId == data.UserId && post.sender_id == data.selectFrienddata) {
                            this.typing = true;
                            
                        }else if(post.sender_id == data.selectFrienddata){
                          const fdata = this.friendList.filter((obj) => {
                              return data.UserId === obj.receiver_id;
                            }).pop();
                          // console.log(fdata);
                          $('#f_typing'+data.UserId).html('<span style="color: green;">is typing ...</span>');
                          this.typing = false;
                          
                        }
                  }
                  
          },

          peekStopTyping(data) {
              console.log('wqwe'+data);
              this.typing = false;
              console.log('dsad'+this.typing);
            // if(data.selectFrienddata){
            //   $('#f_typing'+data.UserId).html(data.selectFrienddata.latestMsg.message);
            // }
            // else{
            //   $('#f_typing'+this.userr).html('Start Chat');
            // }
          },
          receiveupdatechatmsg(updatedata) {
            const data = updatedata;
            const post = this.friendchat.filter((obj) => {
              return updatedata.chatid === obj._id;
            }).pop();
            post.message = data.message;

          },

        },
        mounted() {
         localStorage.setItem('userdata', this.userdata);
        
        this.userr =  localStorage.getItem('userdata');
         localStorage.setItem('user_name', this.user_name);
        // console.log(this.userr);
        this.user_names =  localStorage.getItem('user_name');
        // console.log(this.user_names);
        this.friendlist();
        // var socket = io.connect('https://peekvideochat.com:22000/');
        
        // console.log(socket);
            socket.on('userCount', function (data) {
                this.users = data.userCount;
            }.bind(this));
            socket.on("birdsreceivemsg", function(data){
            // console.log(data.receiver_id+''+this.userr);
            if(data.receiver_id == this.userr){
                this.singleChate.push(data);
                var messagetone = document.getElementById("messagetone");
                messagetone.play();
                messagetone.muted = false;
                this.userdec = this.friendList.filter((obj_friend) => {
                  return data.message_group_id === obj_friend.message_group_id;
                }).pop();
                // console.log("filter_user",this.userdec);
                this.userdec.updatedByMsg = new Date().toISOString();
                var height = 0;
                $(".chat-widget-conversation").each(function(i, value){
                  height += parseInt($(this).height());
                });
                height += 20000;
                $(".chat-widget-conversation").animate({scrollTop: height});
              }
            }.bind(this));

            document.addEventListener('dragenter', function(e) {
              // console.log(e.target.className);
             if (e.target.className == 'col-md-9' || e.target.className == 'chat-widget-conversation' || e.target.className == 'chat-widget-speaker' || e.target.className == 'chat-widget-form' || e.target.className == 'form-row split' || e.target.className == 'form-item' || e.target.className == 'interactive-input small' || e.target.className == 'interactive-input-icon-wrap actionable' || e.target.className == 'tooltip-wrap text-tooltip-tft' || e.target.className == 'form-item auto-width' || e.target.className == 'send-message') {
                // console.log("inside if");
                $("#dropzone").css("display", "block");
              }
              else {
                $("#dropzone").css("display", "none");
              }

            });
        },
        computed: {
          orderedUsers: function() {
            return _.orderBy(this.friendList, 'updatedByMsg', 'desc')
          },
           filteredFriendlist() {
            return this.friendList.filter(post => {
              if (post.sender_id == this.userr) {
                return post.receiver_name.toLowerCase().includes(this.userSearch.toLowerCase())
              }else {
                return post.sender_name.toLowerCase().includes(this.userSearch.toLowerCase())
              }
            })
          },
          singleChateSearch() {
            // console.log(this.singleChate);
            // console.log(this.singleChate);
            // return this.singleChate.filter(user => {
            //         return user.name.toLowerCase().includes(this.userSearch.toLowerCase())
            //      })
            return this.singleChate.filter(user => {
              // console.log(user.message.toLowerCase().includes(this.messageSearch.toLowerCase()));
              return user.message.toLowerCase().includes(this.messageSearch.toLowerCase())
            })
          },
        },
        watch: {
          message: _.debounce(function () {
                socket.emit('alphastopTyping', { selectFrienddata:this.singlefriend, UserId:this.userr});
            }, 1500),
          userSearch(){
           if (this.userSearch.length > 0) {
            // console.log(this.userSearch);
               this.friendData=false;
               this.userSearching=true;
           
             }
             else{
               this.friendData=true;
              this.userSearching=false;
             }
          },
          messageSearch(){
           if (this.messageSearch.length > 0) {
            // console.log(this.messageSearch);
               this.singleChatData=false;
               this.singleChatSearch=true;
           
             }
             else{
               this.singleChatData=true;
              this.singleChatSearch=false;
             }
          },
        },
        methods: {
            randomNumber : function(){
              return Math.round(Math.random()*999999);
            },
            istoday: function (date) {
              return moment(date).calendar();
            },
            removecross() {
              // var socket = io.connect('https://peekvideochat.com:22000/');
              console.log('removecross function ',this.friendId,this.userr);
              socket.emit('peekMsgTyping', { selectFrienddata:this.friendId, UserId:this.userr});
            },
            friendlist: function(){
              axios.get('api/friendsList/'+this.userr)
               .then(responce => {
                // console.log(responce.data);
               this.friendList = responce.data;
               // this.friendList = responce.data;
               // var referrer = document.referrer;
                // alert(referrer);
                var url = (window.location != window.parent.location)
                  ? document.referrer
                  : document.location.href;
                // var url = window.location.href;
                // var url = window.location.origin;
                
                // console.log(url);
                // var currentURL = $(location).attr('href'); 
                // var currentURL = window.location.search;
                // console.log("dsds",currentURL);
                var message_group_id = url.substring(url.lastIndexOf('=') + 1);
                // console.log(message_group_id);
                if (message_group_id) {
                  const post = this.friendList.filter((obj) => {
                    return message_group_id == obj.message_group_id;
                  }).pop();
                  if (post) {
                    $('.user-list-item.active').removeClass('active');
                    $('#'+post.message_group_id).addClass('active');
                    $('#334333002').addClass('active');
                    this.getSingleChat(post);
                    var height = 0;
                    // var container = this.$el.querySelector("#startchat");
                    // $("#startchat").animate({ scrollTop: container.scrollHeight + 7020}, "fast");
                    // console.log(container);
                    $(".chat-widget-conversation").each(function(i, value){
                      height += parseInt($(this).height());
                    });
                    height += 20000;
                    $(".chat-widget-conversation").animate({scrollTop: height});
                    // this.getSingleChat(post);

                  }
                }

               // console.log(this.friendList);
               // console.log(this.friendList);
              })
            },
            getSingleChat: function(single){
              console.log(single);
              this.singleChatUser = single;
              this.message = '';
              this.editChatid = '';
              this.onEditclear = false;
              this.chatreplydata = "";
              this.typing = false;
              this.replyBox = false;

              $('.user-list-item.active').removeClass('active');
              $('#'+this.singleChatUser.message_group_id).addClass('active');
              $('.unread-'+this.singleChatUser.message_group_id).hide();
              $('#selectConversation').hide();
              $('#selectConversation').css('display: none');
              $('#startchat').show();
              var height = 0;
              $(".chat-widget-conversation").each(function(i, value){
                height += parseInt($(this).height());
              });
              height += 20000;
              $(".chat-widget-conversation").animate({scrollTop: height});
              


              // console.log("Chat User",this.singleChatUser);
              if(this.singleChatUser.sender_id == this.userr){
                this.userImage=this.singleChatUser.sender_image;
                this.friendName=this.singleChatUser.receiver_name;
                this.productName=this.singleChatUser.product_name;
                this.friendId=this.singleChatUser.receiver_id;
                this.friendImage=this.singleChatUser.receiver_image;
                this.message_group_id = this.singleChatUser.message_group_id;
                this.friendEmail = this.singleChatUser.receiver_email;
                this.userEmail = this.singleChatUser.sender_email;
                this.chatWithRefId = this.singleChatUser.sender_id;
                if(this.singleChatUser.star_data != ''){
                  this.starBy = this.singleChatUser.star_data[0].star_by;
                }
                if(this.singleChatUser.archive_data != ''){
                  this.archiveBy = this.singleChatUser.archive_data[0].archived_by;
                }
                if(this.singleChatUser.delete_data != ''){
                  this.deleteBy = this.singleChatUser.delete_data[0].delete_by;
                }
                if(this.singleChatUser.unread_data != ''){
                  this.unreadBy = this.singleChatUser.unread_data[0].unread_by;
                }
              
              }else{
                    this.friendName=this.singleChatUser.sender_name;
                    this.productName=this.singleChatUser.product_name;
                    this.friendId=this.singleChatUser.sender_id;
                    this.friendImage=this.singleChatUser.sender_image;
                    this.userImage=this.singleChatUser.receiver_image;
                    this.message_group_id = this.singleChatUser.message_group_id;
                    this.userEmail = this.singleChatUser.receiver_email;
                    this.friendEmail = this.singleChatUser.sender_email;
                    this.chatWithRefId = this.singleChatUser.receiver_id;
                    if(this.singleChatUser.star_data != ''){
                      this.starBy = this.singleChatUser.star_data[0].star_by;
                    }
                    if(this.singleChatUser.archive_data != ''){
                      this.archiveBy = this.singleChatUser.archive_data[0].archived_by;
                    }
                    if(this.singleChatUser.delete_data != ''){
                      this.deleteBy = this.singleChatUser.delete_data[0].delete_by;
                    }
                    if(this.singleChatUser.unread_data != ''){
                      this.unreadBy = this.singleChatUser.unread_data[0].unread_by;
                    }
                    
                    
                    
              }
              // console.log("conversation_id",this.message_group_id);
              // axios.post('https://www.ezvendors.com/chat/public/https://messages.wosom.com/db/chat/public/api/singleChat',{'sender_id':single.sender_id,'receiver_id':single.receiver_id})
              axios.post('api/singleChat',{'sender_id':single.message_group_id})
               .then(responce => {
                // console.log(responce.data);

               this.singleChate = responce.data;
              })

              axios.post('api/seenMessage',{'sender_id':single.sender_id,'receiver_id':this.friendId})
               .then(responce => {
                // console.log(responce.data);

               // this.singleChate = responce.data;
              })
              axios.post('api/readChat',{'message_group_id':single.message_group_id,'user_id':this.userr})
               .then(responce => {
                // console.log(responce.data);

               // this.singleChate = responce.data;
              })
            },
            sendMessage: function() {
            // var socket = io.connect('https://peekvideochat.com:22000/');
            
            var config = {
              header: {
                'Content-Type': 'multipart/form-data'
              }
            }

            if (this.message) {
              if (this.editChatid) {
                var obj = {
                  message: this.message,
                  chatid: this.editChatid
                };

                // console.log(obj);

                this.$socket.emit('peekUpdateChatMsg', obj)
                // this.removecross();
                axios.post('api/updateMessage', {
                  message: this.message,
                  id: this.editChatid
                }).then(response => {

                }, function(err) {
                  console.log('err', err);
                  alert('error');
                })

                this.message = '';
                this.editChatid = '';

              }
              else if (this.chatreplydata) {
                // console.log(this.chatreplydata);
                let meeting_file =  this.$refs.msg_file.files;
                //console.log(meeting_file+',,,,');
                this.chatType = 1;
                var meetingformDatas = new FormData();
                
                  meetingformDatas.append('file',meeting_file[0]);
                  meetingformDatas.append('sender_id',this.userr);
                  meetingformDatas.append('receiver_id',this.friendId);
                  meetingformDatas.append('receiver_name',this.friendName);
                  meetingformDatas.append('sender_name',this.user_names);
                  meetingformDatas.append('message',this.message);
                  meetingformDatas.append('message_group_id',this.message_group_id);
                  meetingformDatas.append('message_status',this.message_status);
                  meetingformDatas.append('sender_email',this.userEmail);
                  meetingformDatas.append('receiver_email',this.friendEmail);
                  meetingformDatas.append('commentId',this.chatreplydata.message_id);
                  meetingformDatas.append('chatType',this.chatType);
               
             
                var d = new Date($.now());
                var time = d.getFullYear()+"-"+(d.getMonth() + 1)+"-"+d.getDate()+" "+d.getHours()+":"+d.getMinutes()+":"+d.getSeconds();
                var  message_type = 0;
                var filename = '';
                if(meeting_file.length > 0){
                   var message_type = 1;
                   filename = meeting_file[0].name;
                }

                
                var obj ={
                  commentId: this.chatreplydata.message,
                  sender_id: this.userr,
                  receiver_id: this.friendId,
                  message: this.message,
                  file: filename,
                  message_type: message_type,
                  sender_name: this.user_names,
                  message_group_id: this.message_group_id,
                  message_status: this.message_status,
                  created_at: time,
                  chatType: 1
                }

                //console.log(this.msgObj);
                this.isSeen = false;
                
                //this.friendCallchat.push(this.msgObj);
                
                // $('#f_typing' + this.singlefriend._id).html(this.msgObj.message);
                // $('#singlemessage-input').css("height", "60px");
                this.replyBox = false;
                this.chatreplydata = "";
                axios.post('api/send-message',obj,config)
                .then(response => {
                  
                  this.singleChate.push(obj);
                  var height = 0;
                  $(".chat-widget-conversation").each(function(i, value){
                    height += parseInt($(this).height());
                  });
                  height += 20000;
                  $(".chat-widget-conversation").animate({scrollTop: height});
                  socket.emit('message', obj);
                  socket.emit('peekStopTyping', { selectFrienddata:this.friendId, UserId:this.userr});
                  this.userdec = this.friendList.filter((obj_friend) => {
                  return this.message_group_id === obj_friend.message_group_id;
                  }).pop();
                  // console.log("filterss_user",this.userdec);
                  this.userdec.updatedByMsg = new Date().toISOString();
                  this.userdec.message_data.message = this.message;
                  this.message = "";
                  this.$refs.msg_file.value=null;


                }, function(err) {
                  console.log('err', err);
                  alert('error');
                })
                var container = this.$el.querySelector("#messageBody");
                $("#messageBody").animate({ scrollTop: container.scrollHeight + 7020 }, "fast");
                
                this.message = '';
                $('#send-msg').addClass('disabled').attr("disabled", "disabled");
              }
              else{

                // console.log("conversation_id Send",this.message_group_id);
                // console.log(this.chatWithRefId+'Selected UIsers'+this.userr);
                if(this.chatWithRefId == this.userr){
                  // console.log('inside if');
                  this.message_status = 'seen';
                }else{
                  // console.log('inside else');
                  this.message_status = 'unread';
                }

                this.chatType = 0;

                let meeting_file =  this.$refs.msg_file.files;
                //console.log(meeting_file+',,,,');
                
                var meetingformDatas = new FormData();
                
                  meetingformDatas.append('file',meeting_file[0]);
                  meetingformDatas.append('sender_id',this.userr);
                  meetingformDatas.append('receiver_id',this.friendId);
                  meetingformDatas.append('receiver_name',this.friendName);
                  meetingformDatas.append('sender_name',this.user_names);
                  meetingformDatas.append('message',this.message);
                  meetingformDatas.append('message_group_id',this.message_group_id);
                  meetingformDatas.append('message_status',this.message_status);
                  meetingformDatas.append('sender_email',this.userEmail);
                  meetingformDatas.append('receiver_email',this.friendEmail);
                  meetingformDatas.append('commentId','');
                  meetingformDatas.append('chatType',this.chatType);
               
             
                var d = new Date($.now());
                var time = d.getFullYear()+"-"+(d.getMonth() + 1)+"-"+d.getDate()+" "+d.getHours()+":"+d.getMinutes()+":"+d.getSeconds();
                var  message_type = 0;
                var filename = '';
                if(meeting_file.length > 0){
                   var message_type = 1;
                   filename = meeting_file[0].name;
                }
             
                var obj ={
                  sender_id: this.userr,
                  receiver_id: this.friendId,
                  message: this.message,
                  file: filename,
                  message_type: message_type,
                  sender_name: this.user_names,
                  message_group_id: this.message_group_id,
                  message_status: this.message_status,
                  created_at: time,
                  chatType: 0
                }
                //console.log(filename+'hghghgh');
                // meetingformDatas.append('meetingformDatas', obj);
                // console.log(obj);
                // socket.emit('message', obj);
                // if(this.friendId == this.userr){
                //   this.$set(this.obj, 'message_status', 'seen');
                // }else{
                //   this.$set(this.obj, 'message_status', 'unread');
                // }

                  axios.post('api/send-message',meetingformDatas,config)
                   .then(responce => {
                    this.singleChate.push(obj);
                    var height = 0;
                    $(".chat-widget-conversation").each(function(i, value){
                      height += parseInt($(this).height());
                    });
                    height += 20000;
                    $(".chat-widget-conversation").animate({scrollTop: height});
                    socket.emit('message', obj);
                    socket.emit('peekStopTyping', { selectFrienddata:this.friendId, UserId:this.userr});
                    this.userdec = this.friendList.filter((obj_friend) => {
                    return this.message_group_id === obj_friend.message_group_id;
                    }).pop();
                    // console.log("filterss_user",this.userdec);
                    this.userdec.updatedByMsg = new Date().toISOString();
                    this.userdec.message_data.message = this.message;
                    this.message = "";
                    this.$refs.msg_file.value=null;

                  })
              }
            }
             
                
            },

            dragfileupload(file, xhr, formData) {
              // console.log(file);
              
              this.chatType = 0;
              formData.append('sender_id',this.userr);
              formData.append('receiver_id',this.friendId);
              formData.append('receiver_name',this.friendName);
              formData.append('sender_name',this.user_names);
              formData.append('message',this.message);
              formData.append('message_group_id',this.message_group_id);
              formData.append('message_status',this.message_status);
              formData.append('sender_email',this.userEmail);
              formData.append('receiver_email',this.friendEmail);
              formData.append('commentId','');
              formData.append('chatType',this.chatType);


            },

            afterComplete(file, response) {
              // console.log(file);
              // console.log(response.data);
              var message_type = 1;
              var d = new Date($.now());
                var time = d.getFullYear()+"-"+(d.getMonth() + 1)+"-"+d.getDate()+" "+d.getHours()+":"+d.getMinutes()+":"+d.getSeconds();

              var obj ={
                sender_id: this.userr,
                receiver_id: this.friendId,
                message: this.message,
                file: file.name,
                message_type: message_type,
                sender_name: this.user_names,
                message_group_id: this.message_group_id,
                message_status: this.message_status,
                created_at: time,
                chatType: 0
              }
              // if (this.singlefriend.chatWithRefId == this.c_user._id) {
              //   // alert('dasdasdas');
              //   this.$set(obj, 'isSeen', 1);
              // }

              // console.log(obj);
              this.isSeen = false;
              this.singleChate.push(obj);
              
              var height = 0;
              $(".chat-widget-conversation").each(function(i, value){
                height += parseInt($(this).height());
              });
              height += 20000;
              $(".chat-widget-conversation").animate({scrollTop: height});
              socket.emit('message', obj);
              socket.emit('alphastopTyping', { selectFrienddata:this.friendId, UserId:this.user_id});
              this.userdec = this.friendList.filter((obj_friend) => {
              return this.message_group_id === obj_friend.message_group_id;
              }).pop();
              // console.log("filterss_user",this.userdec);
              this.userdec.updatedByMsg = new Date().toISOString();
              this.userdec.message_data.message = this.message;
              this.message = "";
              this.$refs.msg_file.value=null;
              // this.$socket.emit('sendmsg', response.data )
              this.$refs.myVueDropzone.removeFile(file);
              $("#dropzone").css("display", "none");
              $("#groupdropzone").css("display", "none");
            },

            uploadfile(event) {
              // var socket = io.connect('https://peekvideochat.com:22000/');
              this.chatType = 0;
              var filesdata = this.$refs.msg_file.files;
              // console.log(filesdata);
              // filesdata.forEach((file) => {
                let formDatas = new FormData();
                let r = Math.random().toString(36).substring(7);
                // formDatas.append('file', file, (r + file.name));
                formDatas.append('file',filesdata[0]);
                formDatas.append('sender_id',this.userr);
                formDatas.append('receiver_id',this.friendId);
                formDatas.append('receiver_name',this.friendName);
                formDatas.append('sender_name',this.user_names);
                formDatas.append('message',this.message);
                formDatas.append('message_group_id',this.message_group_id);
                formDatas.append('message_status',this.message_status);
                formDatas.append('sender_email',this.userEmail);
                formDatas.append('receiver_email',this.friendEmail);
                formDatas.append('commentId','');
                formDatas.append('chatType',this.chatType);

                  var d = new Date($.now());
              var time = d.getFullYear()+"-"+(d.getMonth() + 1)+"-"+d.getDate()+" "+d.getHours()+":"+d.getMinutes()+":"+d.getSeconds();
                let config = {
                  header: {
                    'Content-Type': 'multipart/form-data'
                  }
                }
                var filename = '';
                  if(filesdata.length > 0){
                     var message_type = 1;
                     filename = filesdata[0].name;
                  }
                this.isLoading = true;
                axios.post('api/fileShare', formDatas, config).then((response) => {
                  var obj ={
                    sender_id: this.userr,
                    receiver_id: this.friendId,
                    message: this.message,
                    file: filename,
                    message_type: message_type,
                    sender_name: this.user_names,
                    message_group_id: this.message_group_id,
                    message_status: this.message_status,
                    created_at: time,
                    chatType: 0
                  }
                  

                  this.isSeen = false;
                  this.singleChate.push(obj);
                  this.isLoading = false;
                  // var container = this.$el.querySelector("#chating");
                  // $("#chating").animate({ scrollTop: container.scrollHeight + 7020 }, "fast");
                  var height = 0;
                  $(".chat-widget-conversation").each(function(i, value){
                    height += parseInt($(this).height());
                  });
                  height += 20000;
                  $(".chat-widget-conversation").animate({scrollTop: height});
                  socket.emit('message', obj);
                  socket.emit('alphastopTyping', { selectFrienddata:this.friendId, UserId:this.user_id});
                  this.userdec = this.friendList.filter((obj_friend) => {
                  return this.message_group_id === obj_friend.message_group_id;
                  }).pop();
                  // console.log("filterss_user",this.userdec);
                  this.userdec.updatedByMsg = new Date().toISOString();
                  this.userdec.message_data.message = this.message;
                  this.message = "";
                  this.$refs.msg_file.value=null;
                }, function(err) {
                  console.log('err', err);
                })
              // })
            },
            // selectchatEmoji(emoji) {
            //   this.message += emoji.data;
            //   console.log(this.message);
              
            //     $('#send_message').removeClass('disabled').attr("disabled", false);
              
            // },
            // showChatemoji(){
            //     this.ischatemojiActive = !this.ischatemojiActive;
            // },
            msg_setting(id) {
              $('#msg-setting' + id).siblings('#msg-dropdown' + id).toggle();
              $('#msg-settingo2o' + id).siblings('#msg-dropdowno2o' + id).toggle();
            },
            onCopy: function(e) {

              this.$toasted.success('copied to clipboard', {
                theme: "toasted-primary",
                position: "bottom-center",
                duration: 5000
              })
            },

            onError: function(e) {
              alert('Failed to copy texts')
            },

            copymsg(msg) {
              this.messagecopy = msg;
            },
            chatTime(date) {
              return moment(date).format('LT');
            },
            eidtchat(id, message) {
              this.message = message;
              this.editChatid = id;
              // $('#send_message').css('border-top-right-radius','0');
              // $('#send_message').css('border-top-left-radius','0');
              this.replyBox = false;
              if (this.o2ostatus == true) {
                this.$nextTick(function() {
                  this.$refs. o2oafterClick.focus();
                });
              }else{
                this.$nextTick(function() {
                this.$refs.afterClick.focus();
               });
              }
              this.onEditclear = true;
              this.onChat = false;

            },
            append(emoji) {
                this.message += emoji
            },
            quote(chatdata) {
              this.chatreplydata = chatdata;
              this.onEditclear = false;
              this.message = '';
              $('#send_message').css({'border-top-right-radius':'0','border-top-left-radius':'0'});
              this.replyBox = true;
              if (this.o2ostatus == true) {
                this.$nextTick(function() {
                this.$refs. o2oafterClick.focus();
              });
              }else{
              this.$nextTick(function() {
                this.$refs.afterClick.focus();
              });
            }
            },

            closeReplybox() {
              this.replyBox = false;
              $('#send_message').css({'border-top-right-radius':'12px','border-top-left-radius':'12px'});
            },
            msgdelete(data) {
              // console.log(data);
              // this.$socket.emit('senderdeletemsg', data);
              this.onEditclear = false;
              this.message = '';
              $('#singlemessage-input').css("height", "60px");
              this.replyBox = false;
              $('#sender' + data.message_id).html('message deleted');
              console.log(data.message_id);
              axios.get('api/deleteMsg/' + data.message_id)
                .then((responce) => console.log(responce))
                .catch((error) => console.log(error));

            },
            star(user_id,chat_id){
              // console.log(user_id,chat_id);
              axios.post('api/starChat',{'message_group_id':chat_id,'user_id':user_id})
               .then(responce => {
                // console.log(responce.data);
                $('.star_convo').addClass('active-star');
               // this.singleChate = responce.data;
              })
            },
            unStar(user_id,chat_id){
              // console.log(user_id,chat_id);
              axios.post('api/unstarChat',{'message_group_id':chat_id,'user_id':user_id})
               .then(responce => {
                // console.log(responce.data);
                $(this).removeClass('active-star');
               // this.singleChate = responce.data;
              })
            },
            archive(user_id,chat_id){
              // console.log(user_id,chat_id);
              axios.post('api/archiveChat',{'message_group_id':chat_id,'user_id':user_id})
               .then(responce => {
                // console.log(responce.data);
                $('.star_convo').addClass('active-star');
               // this.singleChate = responce.data;
              })
            },
            unArchive(user_id,chat_id){
              // console.log(user_id,chat_id);
              axios.post('api/unArchiveChat',{'message_group_id':chat_id,'user_id':user_id})
               .then(responce => {
                // console.log(responce.data);
                $(this).removeClass('active-star');
               // this.singleChate = responce.data;
              })
            },
            unreadConv(user_id,chat_id){
              // console.log(user_id,chat_id);
              axios.post('api/unreadConv',{'message_group_id':chat_id,'user_id':user_id})
               .then(responce => {
                // console.log(responce.data);
                $('.star_convo').addClass('active-star');
                $('.unread-'+chat_id).show();
                $('.unread-'+chat_id).html('<span class="badge badge-danger">1</span>&nbsp;<span class="fa fa-envelope-o"></span>');
                $('#selectConversation').show();
                $('#selectConversation').css('display: flex');
                $('#startchat').hide();
               // this.singleChate = responce.data;
              })
            },
            readChat(user_id,chat_id){
              // console.log(user_id,chat_id);
              axios.post('api/readChat',{'message_group_id':chat_id,'user_id':user_id})
               .then(responce => {
                // console.log(responce.data);
                $('.star_convo').addClass('active-star');
               // this.singleChate = responce.data;
              })
            },
            deleteChat(user_id,chat_id){
              // console.log(friend_id,chat_id);
              axios.post('api/deleteConv',{'message_group_id':chat_id,'user_id':user_id})
               .then(responce => {
                // console.log(responce.data);
                $('.star_convo').addClass('active-star');
               // this.singleChate = responce.data;
              })
            },
            getChats(event){
              var getvalue = event.target.value;
              if(getvalue == 'archive'){
                axios.post('api/getArchiveChats',{'user_id': this.userr})
                .then(responce => {
                  this.friendList = '';
                  this.friendList = responce.data;
                  console.log(this.friendList);
                  // this.friendList = responce.data;
                  // var referrer = document.referrer;
                   // alert(referrer);
                   var url = (window.location != window.parent.location)
                     ? document.referrer
                     : document.location.href;
                   // var url = window.location.href;
                   // var url = window.location.origin;
                   
                   // console.log(url);
                   // var currentURL = $(location).attr('href'); 
                   // var currentURL = window.location.search;
                   // console.log("dsds",currentURL);
                   var message_group_id = url.substring(url.lastIndexOf('=') + 1);
                   // console.log(message_group_id);
                   if (message_group_id) {
                     const post = this.friendList.filter((obj) => {
                       return message_group_id == obj.message_group_id;
                     }).pop();
                     if (post) {
                       $('.user-list-item.active').removeClass('active');
                       $('#'+post.message_group_id).addClass('active');
                       $('#334333002').addClass('active');
                       this.getSingleChat(post);
                       var height = 0;
                       // var container = this.$el.querySelector("#startchat");
                       // $("#startchat").animate({ scrollTop: container.scrollHeight + 7020}, "fast");
                       // console.log(container);
                       $(".chat-widget-conversation").each(function(i, value){
                         height += parseInt($(this).height());
                       });
                       height += 20000;
                       $(".chat-widget-conversation").animate({scrollTop: height});
                       // this.getSingleChat(post);

                     }
                   }
                })
              }
              if(getvalue == 'star'){
                axios.post('api/getStarChats',{'user_id': this.userr})
                .then(responce => {
                  this.friendList = '';
                  this.friendList = responce.data;
                  console.log(this.friendList);
                  // this.friendList = responce.data;
                  // var referrer = document.referrer;
                   // alert(referrer);
                   var url = (window.location != window.parent.location)
                     ? document.referrer
                     : document.location.href;
                   // var url = window.location.href;
                   // var url = window.location.origin;
                   
                   // console.log(url);
                   // var currentURL = $(location).attr('href'); 
                   // var currentURL = window.location.search;
                   // console.log("dsds",currentURL);
                   var message_group_id = url.substring(url.lastIndexOf('=') + 1);
                   // console.log(message_group_id);
                   if (message_group_id) {
                     const post = this.friendList.filter((obj) => {
                       return message_group_id == obj.message_group_id;
                     }).pop();
                     if (post) {
                       $('.user-list-item.active').removeClass('active');
                       $('#'+post.message_group_id).addClass('active');
                       $('#334333002').addClass('active');
                       this.getSingleChat(post);
                       var height = 0;
                       // var container = this.$el.querySelector("#startchat");
                       // $("#startchat").animate({ scrollTop: container.scrollHeight + 7020}, "fast");
                       // console.log(container);
                       $(".chat-widget-conversation").each(function(i, value){
                         height += parseInt($(this).height());
                       });
                       height += 20000;
                       $(".chat-widget-conversation").animate({scrollTop: height});
                       // this.getSingleChat(post);

                     }
                   }
                })
              }
              if(getvalue == 'all'){
                axios.get('api/friendsList/'+this.userr)
                .then(responce => {
                  this.friendList = '';
                  this.friendList = responce.data;
                  console.log(this.friendList);
                  // this.friendList = responce.data;
                  // var referrer = document.referrer;
                   // alert(referrer);
                   var url = (window.location != window.parent.location)
                     ? document.referrer
                     : document.location.href;
                   // var url = window.location.href;
                   // var url = window.location.origin;
                   
                   // console.log(url);
                   // var currentURL = $(location).attr('href'); 
                   // var currentURL = window.location.search;
                   // console.log("dsds",currentURL);
                   var message_group_id = url.substring(url.lastIndexOf('=') + 1);
                   // console.log(message_group_id);
                   if (message_group_id) {
                     const post = this.friendList.filter((obj) => {
                       return message_group_id == obj.message_group_id;
                     }).pop();
                     if (post) {
                       $('.user-list-item.active').removeClass('active');
                       $('#'+post.message_group_id).addClass('active');
                       $('#334333002').addClass('active');
                       this.getSingleChat(post);
                       var height = 0;
                       // var container = this.$el.querySelector("#startchat");
                       // $("#startchat").animate({ scrollTop: container.scrollHeight + 7020}, "fast");
                       // console.log(container);
                       $(".chat-widget-conversation").each(function(i, value){
                         height += parseInt($(this).height());
                       });
                       height += 20000;
                       $(".chat-widget-conversation").animate({scrollTop: height});
                       // this.getSingleChat(post);

                     }
                   }
                })
              }
              if(getvalue == 'unread'){
                axios.post('api/getUnreadChats',{'user_id': this.userr})
                .then(responce => {
                  this.friendList = '';
                  this.friendList = responce.data;
                  console.log(this.friendList);
                  // this.friendList = responce.data;
                  // var referrer = document.referrer;
                   // alert(referrer);
                   var url = (window.location != window.parent.location)
                     ? document.referrer
                     : document.location.href;
                   // var url = window.location.href;
                   // var url = window.location.origin;
                   
                   // console.log(url);
                   // var currentURL = $(location).attr('href'); 
                   // var currentURL = window.location.search;
                   // console.log("dsds",currentURL);
                   var message_group_id = url.substring(url.lastIndexOf('=') + 1);
                   // console.log(message_group_id);
                   if (message_group_id) {
                     const post = this.friendList.filter((obj) => {
                       return message_group_id == obj.message_group_id;
                     }).pop();
                     if (post) {
                       $('.user-list-item.active').removeClass('active');
                       $('#'+post.message_group_id).addClass('active');
                       $('#334333002').addClass('active');
                       this.getSingleChat(post);
                       var height = 0;
                       // var container = this.$el.querySelector("#startchat");
                       // $("#startchat").animate({ scrollTop: container.scrollHeight + 7020}, "fast");
                       // console.log(container);
                       $(".chat-widget-conversation").each(function(i, value){
                         height += parseInt($(this).height());
                       });
                       height += 20000;
                       $(".chat-widget-conversation").animate({scrollTop: height});
                       // this.getSingleChat(post);

                     }
                   }
                })
              }
              
            }
        },
        directives: {
            focus: {
              inserted(el) {
                el.focus()
              },
            },
          },
    }

    jQuery(document).ready(function($){
        var height = 0;
        $(".chat-widget-conversation").each(function(i, value){
          height += parseInt($(this).height());
        });
        height += 20000;
        $(".chat-widget-conversation").animate({scrollTop: height});
    
        var login_seller_id = "<?= $login_seller_id; ?>";
        var seller_id = "<?= $seller_id; ?>";
        var message_group_id = "<?= $message_group_id ?>";
    
        $(document).off('submit').on('submit','#insert-message-form', function(event){
          event.preventDefault();
          sendMessage();
          $(this).off('submit'); 
        });
    
        $(document).on('click', '.closeMsg', function(e){
          event.preventDefault();
          $(".chat-widget.static").show();
          $(".message-body").hide();
        });
    
        $('.closeMsg').on('click', function(){
          $(this).parents('.message-body').removeClass('active position-relative');
          $('.user-list-item').removeClass('active');
        });
    
        if ( $(window).width() > 767) {
         // Add your javascript for large screens here 
        }else {
          $('.message-body').hide();
          $(document).on('click', '.user-list-item', function(){
            $('.user-list-item').removeClass('active');
            $(this).addClass('active');
            $('.message-body').addClass('active position-relative');
            $('.chat-widget.static').hide();
            $('.message-body').show();
            // $('.specfic.col-md-8').attr("class","specfic col-md-12");
            $('#msgSidebar').hide();
          });
        }

      $('.menu-btn').click(function(e){
        e.preventDefault();
        e.stopPropagation();
        $('.action-btn').show();
        $(this).hide();
      });
      $(document).click(function() {
        $('.action-btn').hide();
        $('.menu-btn').show();
      }); 

      // $('.select-converation').select2();
      $('.reply').click(function(){

        
        $('.reply-option').show();

      });
      $('.edit').click(function(){
        $('.edit-option').show();

      });

    });
</script>
<style>
  .send-message{
    border-radius: 12px;
  }
  .form-item.split {
    position: relative;
    display: inline-block;
  }

  .regular-input {
    padding: 0.5rem 1rem;
    border-radius: 3px;
    border: 1px solid #ccc;
    width: 20rem;
    height: 12rem;
    outline: none;
  }

  .regular-input:focus {
    box-shadow: 0 0 0 3px rgba(66,153,225,.5);
  }

  .emoji-invoker {
    position: absolute;
    top: 0.8rem;
    right: 3.5rem;
    width: 1.5rem;
    height: 1.5rem;
    border-radius: 50%;
    cursor: pointer;
    transition: all 0.2s;
  }
  .emoji-invoker:hover {
    transform: scale(1.1);
  }
  .emoji-invoker > svg {
    fill: #b1c6d0;
  }

  .emoji-picker {
    position: absolute;
    z-index: 1;
    font-family: Montserrat;
    border: 1px solid #ccc;
    width: 15rem;
    height: 20rem;
    overflow: scroll;
    padding: 1rem;
    box-sizing: border-box;
    border-radius: 0.5rem;
    background: #fff;
    box-shadow: 1px 1px 8px #c7dbe6;
    top: -320px !important;
    left: 280px !important;
    font-size: 14px;
  }
  .emoji-picker__search {
    display: flex;
    margin-bottom: 15px;
  }
  .emoji-picker__search > input {
    flex: 1;
    border-radius: 10rem;
    border: 1px solid #ccc;
    padding: 0.5rem 1rem;
    outline: none;
    font-size: 0.7rem;
  }
  .emoji-picker h5 {
    margin-bottom: 0;
    color: #b1b1b1;
    text-transform: uppercase;
    font-size: 0.8rem;
    cursor: default;
  }
  .emoji-picker .emojis {
    display: flex;
    flex-wrap: wrap;
    justify-content: space-between;
  }
  .emoji-picker .emojis:after {
    content: "";
    flex: auto;
  }
  .emoji-picker .emojis span {
    padding: 0.2rem;
    cursor: pointer;
    border-radius: 5px;
  }
  .emoji-picker .emojis span:hover {
    background: #ececec;
    cursor: pointer;
  }
  .closeMsg{
    position: absolute;
    left: 10px;
    top: 27px;
    font-size: 20px;
  }
  .bg-img{
    width: 40px;
    height: 40px;
  }
  .btn-danger{
    width: 90px;
  }
  .btn-primary{
    width: 100px;
  }
  .about_img{
    height: 100px;
    width: 100px;
  }
  .user-img img{
    width: 40px;
    height: 40px;
  }
  .user-action a{
    padding-left: 5px;
    padding-right: 5px;
    font-size: 15px;
  }
  .menu-btn i{
    font-size: 20px;
  }
  .chat-widget-conversation::-webkit-scrollbar ,.chat-widget-messages::-webkit-scrollbar{
    width: 6px;
    border-radius: 10px;
  }
  /* Track */
  .chat-widget-conversation::-webkit-scrollbar-track,.chat-widget-messages::-webkit-scrollbar-track {
    background: #f1f1f1;
  }
  /* Handle */
  .chat-widget-conversation::-webkit-scrollbar-thumb , .chat-widget-messages::-webkit-scrollbar-thumb{
    background: #888;
    border-radius: 10px;
  }
  /* Handle on hover */
  .chat-widget-conversation::-webkit-scrollbar-thumb:hover, .chat-widget-messages::-webkit-scrollbar-thumb:hover {
    background: #555;
  }
  .chat-widget-header {
    padding: 12px 28px;
  }
  .select-converation:focus{
    outline: 0;
    box-shadow: none;
  }
  .reply-section{
    border-radius: 50%;
    background: #fff7f7;
    padding: 4px;
    display: none;
    margin-left: 10px;
  }
  .edit-section{
    border-radius: 50%;
    background-color: #f9f9f9;
    padding: 4px;
    display: none;
    margin-right: 10px;
  }
  .recieve_message_list:hover .reply-section{
    display: block;
  }
  .send_message_list:hover .edit-section{
    display: block;
  }
  .replybox{
    background-color: #f1f1f1;
    border-top-right-radius: 12px;
    border-top-left-radius: 12px;
    z-index: 9;
  }
  .closeReplyBox{
    cursor: pointer;
    position: absolute;
    right: 5px;
    top: 5px;
    color: white;
    font-size: 13px;
  }
  .closeReplybox{
    position: absolute;
    right: 6px;
    top: 0;
    font-size: 20px;
  }
  .reply-msg{
    display: block;
    padding: 5px 10px;
    background: #9a855b;
    border-radius: 5px;
  }
  .chat-widget-conversation .chat-widget-speaker.right .chat-widget-speaker-message {
    background-color: #cc9933;
  }
  .active-star{
    color: #eaaf38;
  }
  .dropzone {
    box-sizing: border-box;
    display: none;
    position: absolute;
    width: 99%;
    height: 105%;
    z-index: 99999;
    background: #80808066;
    border: 11px dashed #60a7dc;
  }
  .chat-widget-message.user-list-item .user-status-title .bold {
    width: 115px;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
    display: inline-block;
  }
  .chat-widget.static .chat-widget-messages .chat-widget-message {
    padding: 20px 15px 20px 15px;
  }
  .chat-widget-form {
    padding: 22px 15px;
  }
  .chat-widget-message.user-list-item .user-img img{
    width: 45px;
    height: 45px;
  }
  .dz-success-mark, .dz-error-mark{
    display: none;
  }
  @media screen and (max-width: 1366px){
    .content-grid {
        max-width: 100%;
        /*padding: 30px 15px 30px !important;*/
        padding: 0px !important;
        margin: 0 auto;
    }
  }
  @media screen and (max-width: 960px){
    .emoji-picker{
      left: 0 !important;
    }
  }
</style>
