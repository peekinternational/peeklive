<template>
    <div class="">
      <div class="content-grid padding-new p-0">
        <audio id="messagetone" muted>
          <source src="https://www.ezvendors.com/chat/public/img/bell.mp3" type="audio/ogg">
          <source src="https://www.ezvendors.com/chat/public/img/bell.mp3" type="audio/mpeg">
        </audio>
        <!-- GRID -->
        <div class="grid grid-3-12 medium-space">
          <!-- GRID COLUMN -->
          <div class="account-hub-content">
            <!-- <div class="section-header">
              <div class="section-header-info">
                <h2 class="section-title">Messages</h2>
              </div>
            </div> -->
            <!-- CHAT WIDGET WRAP -->
            <div class="chat-widget-wrap">
              <div class="chat-widget static">
                <ul class="nav nav-tabs nav-justified chat-tabs" id="myTab" role="tablist">
                  <li class="nav-item">
                    <a class="nav-link active font-weight-bold border-bottom" id="friends-tab" data-toggle="tab" href="#friends" role="tab" aria-controls="friends" aria-selected="true">All Conversations History <span class="float-right text-danger" @click="deleteAll()"><i class="fa fa-trash"></i> Delete all</span></a>
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
                                <div class="user-avatar small no-outline">
                                  <div class="user-avatar-content">
                                    <template v-if="friends.receiver_image != ''">
                                      <div class="hexagon-image-30-32" data-src="'https://www.ezvendors.com/chat/public/img/user.png'"><img :src="'https://www.ezvendors.com/chat/public/img/user.png'"></div> 
                                    </template>
                                    <template v-else>
                                      <div class="hexagon-image-30-32" data-src="'https://www.ezvendors.com/chat/public/img/user.png'"><img :src="'https://www.ezvendors.com/chat/public/img/user.png'"></div>
                                    </template>
                                  </div>
                                  <div class="user-avatar-progress">
                                    <div class="hexagon-progress-40-44"></div>
                                  </div>
                                  <div class="user-avatar-progress-border">
                                    <div class="hexagon-border-40-44"></div>
                                  </div>
                                  <div class="user-avatar-badge">
                                    <div class="user-avatar-badge-border">
                                      <div class="hexagon-22-24"></div>
                                    </div>
                                    <div class="user-avatar-badge-content">
                                      <div class="hexagon-dark-16-18"></div>
                                    </div>
                                    <!-- <p class="user-avatar-badge-text">6</p> -->
                                  </div>
                                </div>
                              </div>
                            </template>
                            <template v-else>
                              <div class="user-status-avatar">
                                <div class="user-avatar small no-outline">
                                  <div class="user-avatar-content">
                                    <template v-if="friends.sender_image != ''">
                                      <div class="hexagon-image-30-32" data-src="'/img/profileimage/'+friends.sender_image"><img :src="'https://www.ezvendors.com/chat/public/img/user.png'"></div>
                                    </template>
                                    <template v-else>
                                      <div class="hexagon-image-30-32" data-src="https://www.ezvendors.com/chat/public/img/user.png"><img src="'https://www.ezvendors.com/chat/public/img/user.png'"></div>
                                    </template>
                                  </div>
                                  <div class="user-avatar-progress">
                                    <div class="hexagon-progress-40-44"></div>
                                  </div>
                                  <div class="user-avatar-progress-border">
                                    <div class="hexagon-border-40-44"></div>
                                  </div>
                                  <div class="user-avatar-badge">
                                    <div class="user-avatar-badge-border">
                                      <div class="hexagon-22-24"></div>
                                    </div>
                                    <div class="user-avatar-badge-content">
                                      <div class="hexagon-dark-16-18"></div>
                                    </div>
                                    <!-- <p class="user-avatar-badge-text">6</p> -->
                                  </div>
                                </div>
                              </div>
                            </template>
                            <p class="user-status-title mt-2">
                              <template v-if="friends.sender_id == userdata">
                                <span class="bold">{{friends.receiver_name}} with {{friends.sender_name}}</span>
                              </template>
                              <template v-else>
                                <span class="bold">{{friends.sender_name}} with {{friends.receiver_name}}</span>
                              </template>
                            </p>
                            <p>
                              <span class="bold">{{friends.product_name}}</span>
                            </p>
                            
                            <!-- <div :class="'lastMessage-'+friends.message_group_id">
                              <template v-if="userdata == friends.sender_id">
                                <p :id="'f_typing'+friends.receiver_id" v-if="friends.message_id != 0" class="user-status-text">{{friends.message_data.message}}</p>
                              </template>
                              <template v-else>
                                <p :id="'f_typing'+friends.sender_id" v-if="friends.message_id != 0" class="user-status-text">{{friends.message_data.message}}</p>
                              </template>
                            </div> -->
                            <!-- <p class="user-status-text">Great! Then we'll meet with them at the party...</p> -->
                            <!-- <p class="user-status-timestamp floaty">{{istoday(friends.updatedByMsg)}}</p> -->
                            
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
                                <div class="user-avatar small no-outline">
                                  <div class="user-avatar-content">
                                    <template v-if="friends.receiver_info.profileimage != ''">
                                      <div class="hexagon-image-30-32" data-src="'/dashboard-assets/img/profileimage/'+friends.receiver_info.profileimage"><img :src="'/dashboard-assets/img/profileimage/'+friends.receiver_info.profileimage"></div>
                                    </template>
                                    <template v-else>
                                      <div class="hexagon-image-30-32" data-src="'/dashboard-assets/img/avatar/user.png'"><img :src="'/dashboard-assets/img/avatar/user.png'"></div>
                                    </template>
                                  </div>
                                  <div class="user-avatar-progress">
                                    <div class="hexagon-progress-40-44"></div>
                                  </div>
                                  <div class="user-avatar-progress-border">
                                    <div class="hexagon-border-40-44"></div>
                                  </div>
                                  <div class="user-avatar-badge">
                                    <div class="user-avatar-badge-border">
                                      <div class="hexagon-22-24"></div>
                                    </div>
                                    <div class="user-avatar-badge-content">
                                      <div class="hexagon-dark-16-18"></div>
                                    </div>
                                    <!-- <p class="user-avatar-badge-text">6</p> -->
                                  </div>
                                </div>
                              </div>
                            </template>
                            <template v-else>
                              <div class="user-status-avatar">
                                <div class="user-avatar small no-outline">
                                  <div class="user-avatar-content">
                                    <template v-if="friends.sender_info.profileimage != ''">
                                      <div class="hexagon-image-30-32" data-src="'/dashboard-assets/img/profileimage/'+friends.sender_info.profileimage"><img :src="'/dashboard-assets/img/profileimage/'+friends.sender_info.profileimage"></div>
                                    </template>
                                    <template v-else>
                                      <div class="hexagon-image-30-32" data-src="'/dashboard-assets/img/avatar/user.png'"><img :src="'/dashboard-assets/img/avatar/user.png'"></div>
                                    </template>
                                  </div>
                                  <div class="user-avatar-progress">
                                    <div class="hexagon-progress-40-44"></div>
                                  </div>
                                  <div class="user-avatar-progress-border">
                                    <div class="hexagon-border-40-44"></div>
                                  </div>
                                  <div class="user-avatar-badge">
                                    <div class="user-avatar-badge-border">
                                      <div class="hexagon-22-24"></div>
                                    </div>
                                    <div class="user-avatar-badge-content">
                                      <div class="hexagon-dark-16-18"></div>
                                    </div>
                                    <!-- <p class="user-avatar-badge-text">6</p> -->
                                  </div>
                                </div>
                              </div>
                            </template>
                            <p class="user-status-title mt-2">
                              <template v-if="friends.sender_id == userdata">
                                <span class="bold">{{friends.receiver_name}} with {{friends.sender_name}}</span>
                              </template>
                              <template v-else>
                                <span class="bold">{{friends.sender_name}} with {{friends.receiver_name}}</span>
                              </template>
                            </p>
                            <p>
                              <span class="bold">{{friends.product_name}}</span>
                            </p>
                            <!-- <div :class="'lastMessage-'+friends.message_group_id">
                              <template v-if="userdata == friends.sender_id">
                                <p :id="'f_typing'+friends.receiver_id" v-if="friends.message_id != 0" class="user-status-text">{{friends.message_data.message}}</p>
                              </template>
                              <template v-else>
                                <p :id="'f_typing'+friends.sender_id" v-if="friends.message_id != 0" class="user-status-text">{{friends.message_data.message}}</p>
                              </template>
                            </div>
                            <p class="user-status-timestamp floaty">{{istoday(friends.updatedByMsg)}}</p> -->
                          </div>
                        </div>
                        <!-- CHAT WIDGET MESSAGE -->
                      </div>
                    
                    </div>

                  </div>
                  <!-- <div class="tab-pane fade position-relative" id="groups" role="tabpanel" aria-labelledby="groups-tab">
                    <div class="chat-widget-messages" data-simplebar>
                      <div @click="getgroups()">Jerwrwerwe</div>
                      <div class="chat-widget-message" v-for="(group,index) in userGroups">
                        <div class="user-status group_chat" :id="'group_data'+group._id" data-to="group_chat" @click="startgroupchat(group,index)">
                          <div class="user-status-avatar">
                            <div class="user-avatar small no-outline">
                              <div class="user-avatar-content">
                                <div class="hexagon-image-30-32" data-src="/img/04.jpg"></div>
                              </div>
                              <div class="user-avatar-progress">
                                <div class="hexagon-progress-40-44"></div>
                              </div>
                              <div class="user-avatar-progress-border">
                                <div class="hexagon-border-40-44"></div>
                              </div>
                              <div class="user-avatar-badge">
                                <div class="user-avatar-badge-border">
                                  <div class="hexagon-22-24"></div>
                                </div>
                                <div class="user-avatar-badge-content">
                                  <div class="hexagon-dark-16-18"></div>
                                </div>
                                <p class="user-avatar-badge-text">6</p>
                              </div>
                            </div>
                          </div>
                          <p class="user-status-title"><span class="bold">Bearded Wonder</span></p>
                          <p class="user-status-text">Great! Then we'll meet with them at the party...</p>
                          <p class="user-status-timestamp floaty">2 hours ago</p>
                        </div>
                      </div>
                    </div>
                    <button type="button" data-toggle="modal" data-target="#addGroup" class="btn rounded-circle add-group-btn"><i class="fa fa-plus"></i></button>
                  </div> -->
                </div>
                <!-- /CHAT WIDGET MESSAGES -->
                <!-- CHAT WIDGET FORM -->
                <!-- <form class="chat-widget-form">
                  <div class="interactive-input small">
                    <input type="text" id="chat-widget-search-2"  v-model="userSearch" placeholder="Search Messages...">
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
                </form> -->
                <!-- /CHAT WIDGET FORM -->
              </div>
              <!-- /CHAT WIDGET -->

              <!-- CHAT WIDGET -->
              <div class="chat-widget message-body">
                <center id="selectConversation" class="mt-5 pt-5 mt-sm-5 pt-sm-5" >
                  <img src="img/logo.png" width="180" alt="">
                  <h3 class="mt-3 empty-heading" style="font-weight:400;">Chat History</h3>
                  <!-- <p class="lead">Try selecting a conversation or searching for someone specific.</p> -->
                </center>
                <div id="startchat" style="display: none;">
                  <div class="chat-widget-header">
                    <!-- <div class="chat-widget-settings">
                      <div class="post-settings-wrap">
                        <div class="post-settings widget-box-post-settings-dropdown-trigger">
                          <svg class="post-settings-icon icon-more-dots">
                            <use xlink:href="#svg-more-dots"></use>
                          </svg>
                        </div>
                        <div class="simple-dropdown widget-box-post-settings-dropdown">
                          <p class="simple-dropdown-link">Report</p>
                          <p class="simple-dropdown-link">Block</p>
                          <p class="simple-dropdown-link">Mute</p>
                        </div>
                      </div>
                    </div> -->
                    <span class="closeMsg d-lg-none d-md-none"><i class="fa fa-chevron-left"></i></span>
                    <div class="user-status">
                      <div class="user-status-avatar">
                        <div class="user-avatar small no-outline online">
                          <div class="user-avatar-content">
                            <template v-if="friendImage != ''">
                              <div class="hexagon-image-30-32" data-src="'/img/profileimage/'+friendImage"><img :src="'https://www.ezvendors.com/chat/public/img/user.png'"></div>
                            </template>
                            <template v-else>
                            <div class="hexagon-image-30-32" data-src="https://www.ezvendors.com/chat/public/img/user.png"><img src="'https://www.ezvendors.com/chat/public/img/user.png'"></div>
                            </template>
                          </div>
                          <div class="user-avatar-progress">
                            <div class="hexagon-progress-40-44"></div>
                          </div>
                          <div class="user-avatar-progress-border">
                            <div class="hexagon-border-40-44"></div>
                          </div>
                          <div class="user-avatar-badge">
                            <div class="user-avatar-badge-border">
                              <div class="hexagon-22-24"></div>
                            </div>
                            <div class="user-avatar-badge-content">
                              <div class="hexagon-dark-16-18"></div>
                            </div>
                            <!-- <p class="user-avatar-badge-text">16</p> -->
                          </div>
                        </div>
                      </div>
                      <p class="user-status-title" style="margin-top: 8px;"><span class="bold">{{friendName}} with {{UserName}}</span></p>
                      <p>{{productName}}</p>
                      <span class="position-absoulte delete-chat" @click="deleteChat(messageGroupId)"><i class="fa fa-trash"></i>Delete Conversation </span>
                      <!-- <p class="user-status-tag online">Online</p> -->
                    </div>
                  </div>
                  <!-- /CHAT WIDGET HEADER -->
                  <!-- CHAT WIDGET CONVERSATION -->
                  <div class="chat-widget-conversation">
                    <div class="chat-widget-speaker right" v-for=" chat in singleChate"  v-if="chat.sender_id == userdata">
                      <!-- <template v-if="chat.message !== ''">
                        <p class="chat-widget-speaker-message" v-if="chat.message != ''">{{chat.message}}</p>
                      </template>
                      <template v-if="chat.message_type == 1">
                        <div>
                          <img :src="'https://www.ezvendors.com/chat/public/chat_images/'+chat.file" alt="..." class="img-thumbnail" width="100">
                        </div>
                        
                        <a :href="'https://www.ezvendors.com/chat/public/chat_images/'+chat.file" download class="d-block mt-2 ml-1"  style="color: #ff0707;">
                        <i class="fa fa-download"></i> {{chat.file}}
                        </a>
                        </template>
                      <p class="chat-widget-speaker-timestamp">{{istoday(chat.created_at)}}</p> -->
                    </div>
                    <div class="chat-widget-speaker left" v-else>
                      <div class="chat-widget-speaker-avatar">
                        <div class="user-avatar tiny no-border">
                          <div class="user-avatar-content">
                            <template v-if="friendImage != ''">
                              <div class="hexagon-image-24-26" data-src="'/img/profileimage/'+friendImage"><img :src="'https://www.ezvendors.com/chat/public/img/user.png'"></div>
                            </template>
                            <template v-else>
                            <div class="hexagon-image-24-26" data-src="'/img/user.png'"><img :src="'https://www.ezvendors.com/chat/public/img/user.png'"></div>
                            </template>
                          </div>
                        </div>
                      </div>
                      <p class="font-weight-bold mb-2">{{chat.sender_name}}</p>
                      <template v-if="chat.message != ''">
                        <p class="chat-widget-speaker-message" v-if="chat.message != ''">{{chat.message}}</p>
                      </template>
                      <template v-if="chat.message_type == 1">
                        <div>
                          <img :src="'https://www.ezvendors.com/chat/public/chat_images/'+chat.file" alt="..." class="img-thumbnail" width="100">
                        </div>
                        <a :href="'https://www.ezvendors.com/chat/public/chat_images/'+chat.file" download class="d-block mt-2 ml-1"  style="color: #ff0707;">
                        <i class="fa fa-download"></i> {{chat.file}}
                        </a>
                        </template>
                      <p class="chat-widget-speaker-timestamp">{{istoday(chat.created_at)}}</p>
                    </div>
                    <!-- CHAT WIDGET SPEAKER -->
                  </div>
                  <!-- /CHAT WIDGET CONVERSATION -->

                  <!-- CHAT WIDGET FORM -->
                  <!-- <form class="chat-widget-form"> -->
                 <!--  <div class="chat-widget-form">
                            
                    <div class="form-row split">
                      <div class="form-item">
                        <input type="hidden" name="sender_id" v-model="sender_id">
                        <input type="hidden" name="receiver_id" v-model="receiver_id">
                        <input type="hidden" name="receiver_name" v-model="receiver_name" >
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
                              <input type="file" ref="msg_file" id="file" hidden="" multiple />
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
                        </button>
                      </div>
                    </div>
                  </div> -->
                </div>
                <!-- </form> -->
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
      Vue.use(EmojiPicker);
    export default {
        name: 'ExampleComponent',
        components: { EmojiPicker },
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
                productName:"",
                UserName:"",
                messageGroupId:"",
                user_names:"",
                friendId:"",
                friendImage:"",
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
            }
        },
        sockets: {
          connect: function() {
            console.log('socket connected successfully')
          },

          disconnect() {
            console.log('socket disconnected')
          },

          alphastarttyping(data) {
            //   console.log('jlkjkjkj'+data);
            // this.typing = true;
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

          alphastoptyping(data) {
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

        },
        mounted() {
         localStorage.setItem('userdata', this.userdata);
        
        this.userr =  localStorage.getItem('userdata');
         localStorage.setItem('user_name', this.user_name);
        console.log(this.userr);
        this.user_names =  localStorage.getItem('user_name');
        console.log(this.user_names);
        this.friendlist();
        var socket = io.connect('https://peekvideochat.com:22000/');
        
        // console.log(socket);
            socket.on('userCount', function (data) {
                this.users = data.userCount;
            }.bind(this));
            socket.on("birdsreceivemsg", function(data){
            console.log(data.receiver_id+''+this.userr);
            if(data.receiver_id == this.userr){
                this.singleChate.push(data);
                var messagetone = document.getElementById("messagetone");
                messagetone.play();
                messagetone.muted = false;
                this.userdec = this.friendList.filter((obj_friend) => {
                  return data.message_group_id === obj_friend.message_group_id;
                }).pop();
                console.log("filter_user",this.userdec);
                this.userdec.updatedByMsg = new Date().toISOString();
                var height = 0;
                $(".chat-widget-conversation").each(function(i, value){
                  height += parseInt($(this).height());
                });
                height += 20000;
                $(".chat-widget-conversation").animate({scrollTop: height});
              }
            }.bind(this));
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
              console.log(user.message.toLowerCase().includes(this.messageSearch.toLowerCase()));
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
            console.log(this.messageSearch);
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
              this.$socket.emit('alphamsgtyping', { selectFrienddata:this.friendId, UserId:this.user_id});
            },
            friendlist: function(){
              axios.get('https://www.ezvendors.com/chat/public/api/allChats/')
               .then(responce => {
                // console.log(responce.data);
               this.friendList = responce.data;
               // this.friendList = responce.data;

                var url = window.location.href;
                // var url = window.location.origin;
                console.log(url);
                // var currentURL = $(location).attr('href'); 
                var currentURL = window.location.search;
                console.log("dsds",currentURL);
                var message_group_id = url.substring(url.lastIndexOf('=') + 1);
                console.log(message_group_id);
                if (message_group_id) {
                  const post = this.friendList.filter((obj) => {
                    return message_group_id == obj.message_group_id;
                  }).pop();
                  if (post) {
                    $('#'+post.message_group_id).addClass('active');
                    // $('#1212577981').addClass('active');
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
               console.log(this.friendList);
              })
            },
            getSingleChat: function(single){
              this.singleChatUser = single;
              $('.user-list-item.active').removeClass('active');
              $('#'+this.singleChatUser.message_group_id).addClass('active');
              $('#selectConversation').hide();
              $('#startchat').show();
              var height = 0;
              $(".chat-widget-conversation").each(function(i, value){
                height += parseInt($(this).height());
              });
              height += 20000;
              $(".chat-widget-conversation").animate({scrollTop: height});
              

              console.log("Chat User",this.singleChatUser);
              if(this.singleChatUser.sender_id == this.userr){
                this.userImage=this.singleChatUser.sender_image;
                this.friendName=this.singleChatUser.receiver_name;
                this.UserName=this.singleChatUser.sender_name;
                this.friendId=this.singleChatUser.receiver_id;
                this.friendImage=this.singleChatUser.receiver_image;
                this.messageGroupId = this.singleChatUser.message_group_id;
                this.message_group_id = this.singleChatUser.message_group_id;
                this.productName = this.singleChatUser.product_name;
              //console.log(this.friendImage);
              }else{
                    this.friendName=this.singleChatUser.sender_name;
                    this.UserName=this.singleChatUser.receiver_name;
                    this.friendId=this.singleChatUser.sender_id;
                    this.friendImage=this.singleChatUser.sender_image;
                    this.userImage=this.singleChatUser.receiver_image;
                    this.messageGroupId = this.singleChatUser.message_group_id;
                    this.message_group_id = this.singleChatUser.message_group_id;
                    this.productName = this.singleChatUser.product_name;
                    //console.log(this.friendImage);
              }
              console.log("conversation_id",this.messageGroupId);
              axios.post('https://www.ezvendors.com/chat/public/api/singleChatAll',{'message_group_id':single.message_group_id})
               .then(responce => {
                console.log(responce.data);

               this.singleChate = responce.data;
              })

            },
            sendMessage: function() {
            var socket = io.connect('https://peekvideochat.com:22000/');
            
            var config = {
              header: {
                'Content-Type': 'multipart/form-data'
              }
            }
            console.log("conversation_id Send",this.message_group_id);
          // console.log(this.friendId);
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
              }
              //console.log(filename+'hghghgh');
              // meetingformDatas.append('meetingformDatas', obj);
              // console.log(obj);
              // socket.emit('message', obj);
              if(this.friendId == this.receiver_id){
                this.$set(this.obj, 'message_status', 'seen');
              }

                  axios.post('https://www.ezvendors.com/chat/public/api/send-message',meetingformDatas,config)
                   .then(responce => {
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
                    console.log("filterss_user",this.userdec);
                    this.userdec.updatedByMsg = new Date().toISOString();
                    // this.userdec.message_data.message = this.message;
                    this.message = "";
                    this.$refs.msg_file.value=null;

                  })
             
                
            },

            uploadfile(event) {
              var socket = io.connect('https://peekvideochat.com:22000/');
              var filesdata = this.$refs.msg_file.files;
              // filesdata.forEach((file) => {
                let formDatas = new FormData();
                let r = Math.random().toString(36).substring(7);
                // formDatas.append('file', file, (r + file.name));
                formDatas.append('file', filesdata[0]);
                formDatas.append('sender_id', this.userr);
                formDatas.append('sender_name', this.user_names);
                formDatas.append('receiver_id', this.friendId);
                formDatas.append('receiver_name',this.friendName);
                formDatas.append('message_group_id',this.message_group_id);
                formDatas.append('message_status',this.message_status);

                  var d = new Date($.now());
              var time = d.getFullYear()+"-"+(d.getMonth() + 1)+"-"+d.getDate()+" "+d.getHours()+":"+d.getMinutes()+":"+d.getSeconds();
                let config = {
                  header: {
                    'Content-Type': 'multipart/form-data'
                  }
                }
                var filename = '';
                  if(filesdata.length > 0){
                     // var message_type = 1;
                     filename = filesdata[0].name;
                  }
                this.isLoading = true;
                axios.post('https://www.ezvendors.com/chat/public/api/send-message', formDatas, config).then((response) => {
                  this.msgObj = {
                    message_type: 1,
                    sender_id: this.userr,
                    receiver_id: this.friendId,
                    sender_name: this.user_names,
                    receiver_name: this.friendName,
                    message: this.message,
                    file: filename,
                    created_at: time,
                  };
                  

                  this.isSeen = false;
                  this.singleChate.push(this.msgObj);
                  this.isLoading = false;
                  // var container = this.$el.querySelector("#chating");
                  // $("#chating").animate({ scrollTop: container.scrollHeight + 7020 }, "fast");
                  socket.emit('message', msgObj);
                  this.userdec = this.friendList.filter((obj_friend) => {
                    return this.message_group_id === obj_friend.message_group_id;
                    }).pop();
                  this.userdec.updatedByMsg = new Date().toISOString();


                  setTimeout(() => {
                    const id = $(".active.init").attr("id");

                    if (id != 'friend' + this.singlefriend._id) {
                      $('.init').removeClass("active");
                      setTimeout(() => {

                        $('#friend' + this.singlefriend._id).addClass("active");
                        setTimeout(() => {

                          // $('.chat-main .active .details h6').html('<span>You : </span>' + response.data.message);
                        }, 200);

                      }, 1);


                    }
                  }, 0);
                }, function(err) {
                  console.log('err', err);
                })
              // })
            },
            deleteChat: function(groupId){
              console.log("conversation_id",this.groupId);
              confirm("Are you sure you want to delete conversation!")
              axios.post('https://www.ezvendors.com/chat/public/api/deleteUserChat',{'message_group_id':groupId})
               .then(responce => {
                console.log(responce.data);

               this.singleChate = responce.data;
              })
            },
            deleteAll: function(){
              confirm("Are you sure you want to delete all conversations!")
              axios.post('https://www.ezvendors.com/chat/public/api/deleteAllChats')
               .then(responce => {
                console.log(responce.data);

               this.singleChate = responce.data;
               this.friendList = responce.data;

              })
            },

            // selectchatEmoji(emoji) {
            //   this.message += emoji.data;
            //   console.log(this.message);
              
            //     $('#send_message').removeClass('disabled').attr("disabled", false);
              
            // },
            // showChatemoji(){
            //     this.ischatemojiActive = !this.ischatemojiActive;
            // },
            append(emoji) {
                this.message += emoji
            },
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
