<!-- //  for the error messages  -->

<?php
if (isset($message)) {
    foreach ($message as $message) {
        echo '
       <div class="message">
                    <span style="color: red;">' . $message . '</span>
                    <i class="fas fa-times" style="cursor: pointer;" onclick="this.parentElement.remove();"></i>
                </div>
          ';
    }
}
?>


<?php
// if (isset($message)) {
//     foreach ($message as $msg) {
//         echo "
//         <script>
//             setTimeout(function() {
//                 let messageDiv = document.createElement('div');
//                 messageDiv.className = 'message';
//                 messageDiv.innerHTML = `<span style='color: red;'>$msg</span>
//                                        <i class='fas fa-times' onclick='this.parentElement.remove();'></i>`;
//                 document.body.appendChild(messageDiv);
//             }, 1000); // Delay of 1 second
//         </script>
//         ";
//     }
// }
?>

<?php
// if (isset($message)) {
//     foreach ($message as $msg) {
//         echo "
//         <div class='message' style='position: fixed; top: 10px; right: 10px; background-color: #ffdddd; color: red; padding: 10px; border: 1px solid red; border-radius: 5px;'>
//             <span>$msg</span>
//             <i class='fas fa-times' onclick='this.parentElement.remove();' style='cursor: pointer; margin-left: 10px;'>❌</i>
//         </div>

//         <script>
//             setTimeout(function() {
//                 const messages = document.querySelectorAll('.message');
//                 messages.forEach(msg => msg.remove());
//             }, 3000); // Message disappears after 3 seconds
//         </script>
//         ";
//     }
// }
?>



<!-- //  End of "for the error messages"  -->


<!-- <div class="message">
                    <span style="color: red;">' . $message . '</span>
                    <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
                </div> -->