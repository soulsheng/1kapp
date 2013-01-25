// Basic line-buffered keyboard input. 
// Author: J. M. Morris 
// Version 1.3      February 29th 2000.
//
//
 
import java.io.*;

public class Keyboard {
    private static BufferedReader br = new BufferedReader(
                new InputStreamReader(System.in));
    private static String buffer = "";
    private static int p = 1; // buffer[p..] contains next input

    private static String getToken() throws IOException {
        while (buffer != null && (p>= buffer.length() || 
                Character.isWhitespace(buffer.charAt(p)))) {
            if (p>= buffer.length()) {
                buffer = br.readLine();
                p = 0;
            }
            else p++;
        }
        if (buffer == null) throw new IOException("Unexpected end of file.");
        int t = p;
        p++;
        while(p < buffer.length() &&
                !(Character.isWhitespace(buffer.charAt(p))))
            p++;
        p++;
        return(buffer.substring(t,p-1));
    }

    public static int readInt() {
    // Consume and return an integer. Trailing delimiter consumed.
        try {   return Integer.parseInt(getToken());
        } catch (Exception e) {
            System.err.println("IO Exception in Keyboard.readInt");
            return 0;
        }
    }   

    public static boolean readBoolean() {
    // Consume and return a boolean. Trailing delimiter consumed.
    // Any string other than "