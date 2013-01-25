class linkMan{
	private String name;
	private String mobilePhone;
	public linkMan(String n,String mp)throws Exception{
		name=n;
		if(mp.length()!=11)
			throw new Exception("Mobile phone number should be 11 digits");
		else{
			for(int j=0;j<mp.length();j++){
				char c=mp.charAt(j);
				if(c<'0'||c>'9')
					throw new Exception("Phone number should be all digit");
			}
			mobilePhone=mp;
		}
	}
	public String getName(){
		return name;
	}
	public String getMobilePhone(){
		return mobilePhone;
	}
}
public class ch7ex7{
	public static void main(String[]args){
		System.out.print("Enter your name: ");
		String name=Keyboard.readString();
		System.out.print("Enter your mobile phone: ");
		String mobile=Keyboard.readString();
		try{
			linkMan p1=new linkMan(name,mobile);
			System.out.println(p1.getName()+"   "+p1.getMobilePhone());
		}catch(Exception e){
			System.out.println(e.getMessage());
		}
	}
}
		