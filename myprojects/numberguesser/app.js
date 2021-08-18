// /*
// Game Function/rules:
// -Player must guess a number between a min and max
// -Player gets a certain amount of guesses 
// -Notify player of guesses remaining 
// -Notify the player of the correct answer if they lose
// -Let player choose to play again
// */

// //Game values
// let min = 1,
//     max = 10,
//     winningNum = getRandomNum(min, max),
//     guessesLeft = 3;

// //UI Elements 
// const game = document.querySelector('#game'),
//       minNum = document.querySelector('.min-num'),
//       maxNum = document.querySelector('.max-num'),
//       guessBtn = document.querySelector('#guess-btn'),
//       guessInput = document.querySelector('#guess-input'),
//       message = document.querySelector('.message');

// // Assign UI min and max
// minNum.textContent = min;
// maxNum.textContent = max;    

// //Play again event listener
// game.addEventListener('mousedown', function(e){
//   if(e.target.className === 'play-again'){
//     window.location.reload();
//   }
// });

// // Listen for guess
// guessBtn.addEventListener('click', function(){
//   let guess = parseInt(guessInput.value);
  

// //Validate 
// if (isNaN(guess) || guess < min || guess > max){
//   setMessage(`Please enter a number between ${min} and ${max}`,'red');
// }

// // Check if won
// if(guess === winningNum){
//   //Game over won
//   gameOver(true, `${winningNum} is correct, YOU WIN!`);

// } else {
//   //Wrong number
//   guessesLeft -=1;

//   if(guessesLeft === 0){
//     //Game over Lost 
    
//     gameOver(false,`Game over, you lost. The correct number was ${winningNum}`);
//   }else {
//     //Game continues answer wrong

//     //Change border color
//   guessInput.style.borderColor = 'red';

//   //Clear input
//   guessInput.value = '';

//     // Tell user its the wrong number and the number of guesses they have left
//   setMessage(`${guess} is not correct, ${guessesLeft} guesses left`, 'red');

//   }

// }
// });

// //Game over
// function gameOver(won, msg){

//   let color;
//   won === true ? color = 'green' : color = 'red';

//   //Disable input
//   guessInput.disabled = true;
//   //Change border color
//   guessInput.style.borderColor = color;
//   // Set text color 
//   message.style.color = color;
//   // Set message
//   setMessage(msg);

//   //Play again?
//   guessBtn.value = 'Play Again';
//   guessBtn.className +='play-again';

// }

// //Get winning number
// function getRandomNum(min, max){
//   return Math.floor(Math.random()*(max-min+1)+min);

// }

// // Set message
// function setMessage(msg, color){
//   message.style.color = color;
//   message.textContent = msg;
// }

let min = 1,
    max = 10,
    winningNum = getRandomNum(min, max),
    guessesLeft = 3;

//Ui Elements
const game = document.querySelector('#game'),
      minNum = document.querySelector('.min-num'),
      maxNum = document.querySelector('.max-num'),
      guessBtn = document.querySelector('#guess-btn'),  
      guessInput = document.querySelector('#guess-input'),
      message = document.querySelector('.message');

// Assign UI min and max
minNum.textContent = min;
maxNum.textContent = max;  

// Play Again
game.addEventListener('mousedown', function(e){
  if(e.target.className === 'play-again'){
   window.location.reload(); 
  }
});

//listen for quess
guessBtn.addEventListener('click', function(){
  let guess = parseInt(guessInput.value);

  //Validate input
  if(isNaN(guess) || guess < min || guess > max){
    setMessage(`Please enter a number between ${min} and ${max}`, 'red');
  }

  // check if they won
  if (guess === winningNum){

    gameOver(true, `${winningNum} is correct,YOU WIN!`);

  }else {
    // The wrong number
    guessesLeft -= 1;

    if(guessesLeft === 0){
      //GAME OVER LOST
      gameOver(false, `Game Over, you lost. The correct number was ${winningNum}`);

    }else {
      // GAME CONTINUES-  ANSWER WRONG

      guessInput.style.borderColor = 'red';

      //Clear input
      guessInput.value = '';

      // Tell user it's the wrong number
      setMessage(`${guess} is not correct, ${guessesLeft} guesses left`, 'red');
    }
  }
});

//Function Game OVER
function gameOver(won, msg){
  let color;
  won === true ? color = 'green' : color = 'red';
  // Disable input
  guessInput.disabled = true;

  guessInput.style.borderColor = color;

  message.style.color = color;

  setMessage(msg);

  //PLAY AGAIN
  guessBtn.value = 'Play Again';
  guessBtn.className += 'play-again';
}

//Get winning number
function getRandomNum(min, max){
  return Math.floor(Math.random()*(max-min+1)+min);

}

function setMessage (msg, color){
  message.style.color = color;
  message.textContent = msg;
}