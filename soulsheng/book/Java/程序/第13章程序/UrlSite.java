import java.net.*;
import java.io.*;
public class UrlSite{
	public static void urlSiteGet(String urlName){
		String str;
		URL url=null;
		InputStream urlStream=null;
		try{
			url=new URL(urlName);
		}catch(Exception e){
			System.out.println("URL error");
		}
		try{
			urlStream=url.openStream();
			DataInputStream dIn=new DataInputStream(urlStream);
			BufferedReader d= new BufferedReader(new InputStreamReader(dIn));
			while((str=d.readLine())!=null){
				System.out.println(str);
			}
		}catch(IOException e){
			System.out.println("URL file open error");
		}
	}
	public static void main(String args[]){
		System.out.println("Enter a URL: ");
		String urlString=Keyboard.readString();
		urlSiteGet(urlString);
	}
}