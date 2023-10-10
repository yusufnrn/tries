import java.util.Scanner;

public class ucgen {
    public static void main(String[] args) {

        Scanner scanner = new Scanner(System.in);
        System.out.print("Üçgenin boyutu : ");

        int boyut = scanner.nextInt();
        if(boyut >0) {
            for (int i = 0; i < boyut; i++) {

                for (int j = boyut; j >= i; j--) {
                    System.out.print(" ");
                }
                for (int j = 0; j < i; j++) {
                    System.out.print("* ");
                }
                System.out.println();
            }
        }else {
            System.out.println("Boyut sıfırdan küçük olamaz!!");
        }
    }
}