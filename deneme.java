import java.util.Scanner;

public class deneme {
    public static void main(String[] args) {
        Scanner scanner = new Scanner(System.in);
        System.out.println("Merhaba!");
        System.out.println("Bir islem seciniz!!");
        String string = new String ("\n1. Toplama" +
                                   "\n2. Cikarma" +
                                   "\n3. Carpma" +
                                   "\n4. Bolme");
        System.out.println(string);
        int i = scanner.nextInt();
        if(i == 1){
            System.out.println("Toplanacak iki sayi giriniz: ");
            int number1 = scanner.nextInt();
            int number2 = scanner.nextInt();
            int sonuc = number1 + number2;
            System.out.println("Sayilarin Toplami: " + sonuc );
        }
        else if (i == 2) {
            System.out.println("Cikarilacak iki sayi giriniz: ");
            int number1 = scanner.nextInt();
            int number2 = scanner.nextInt();
            int sonuc = number1 - number2;
            System.out.println("Sayilarin Farki: " + sonuc);
        }
             else if (i == 3) {
                System.out.println("Carpilacak iki sayi giriniz: ");
                int number1 = scanner.nextInt();
                int number2 = scanner.nextInt();
                int sonuc = number1 * number2;
                System.out.println("Sayilarin Carpimi: " + sonuc);
            }
        else if (i == 4) {
            System.out.println("Bolunecek sayilari giriniz: ");
            int number1 = scanner.nextInt();
            int number2 = scanner.nextInt();
            int sonuc = number1 / number2;
            System.out.println("Sayilarin Bolumu: " + sonuc);
            }
        }
}
