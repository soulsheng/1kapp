public class ch4ex5{
	public static void main(String[]args){
		char ch;
		System.out.print("Enter a character:");
		ch=Keyboard.readChar();
		if(Character.isDigit(ch)){
			System.out.println(ch+"is digit");
		}
		else if(Character.isLetterOrDigit(ch)){
			System.out.println(ch+"is letter");
			if(Character.isLowerCase(ch)){
				System.out.println(ch+"is lower case letter");
				System.out.println("it's upper case letter is"+Character.toUpperCase(ch));
			}
			else{
				System.out.println(ch+"is upper case letter");
				System.out.println("it's lower case letter is"+Character.toLowerCase(ch));
			}
		}
	}
}