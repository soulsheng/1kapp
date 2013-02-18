public class ch6ex19{
  public static void main(String[] args) {
    String s1="Computer";
    String s = "My "+s1+" course is "+Integer.toString(87);
    System.out.println(s);
    // The "equivalent" using StringBuffer:
    StringBuffer sb = 
      new StringBuffer("My "); // Creates String!
    sb.append(s1);
    sb.append(" course is "); // Creates String!
    sb.append(Integer.toString(87));
    System.out.println(sb);
    //insert not after is
    sb.insert(21," not");
    String st=sb.toString();
    System.out.println(st);
    //delete the word Computer
    sb.delete(3,12);
    System.out.println(sb);
    System.out.println("The buffer capacity is "+sb.capacity());
    System.out.println("The string length is "+sb.length());
  }
} 
