# Kata Bowling.

The goal of this kata is to calculate the score of a Bowling game. The script will read a string
containing every run of a player and will output the final score.

We will consider the following:
 * the format of the string passed to the script is valid
 * we only want the final score

Here is the list of rules for the calculation of the score of a Bowling ten-pin game:

 * A game is divided in 10 frames
 * In a frame the player has two balls to knock down the pins
 * The score after each round is the number of koncked down pins
 * If, after the first ball of a frame, every pin are knocked down it is a strike and the score is 10 points
   plus the score of the next two balls
 * If, after the second ball of a frame, every pin are knocked down it is a spare and the score is 10 points
 * On the last frame, if the player do a strike or a spare, then he can play two or one more ball. The score of each bonus
   balls are added to the score of the latest frame.

Examples:

Input:  "XXXXXXXXXXXX" (12 balls: 12 strikes)
Output: 300
Calcul: 10+10+10 + 10+10+10 + 10+10+10 + 10+10+10 + 10+10+10 + 10+10+10 + 10+10+10 + 10+10+10 + 10+10+10 + 10+10+10

Input:  "9-9-9-9-9-9-9-9-9-9-" (20 balls: 9 knocked down on the first ball of each frame, 0 on the second one)
Output: 90
Calcul: 9 + 9 + 9 + 9 + 9 + 9 + 9 + 9 + 9 + 9

Input:  "5/5/5/5/5/5/5/5/5/5/5" (21 balls: 10 spares + 5 pins on the bonus ball)
Output: 150
Calcul: 10+5 + 10+5 + 10+5 + 10+5 + 10+5 + 10+5 + 10+5 + 10+5 + 10+5 + 10+5

# Credits

http://www.developpeur-agile.fr/2012/12/21/exercice-kata-bowling/ (french)